<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends CI_Controller {

    public function render () {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');
        $this->load->helper('files');

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        if ($this->isOwner('name', $this->uri->segment(4), $user['id'])!==true) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }

        $img = str_replace('/', '', $this->uri->segment(4));

        $path = getPath($img);

        $fileInfo = $this->Model_files->getOneFile('name', $this->uri->segment(4));

        header( 'Content-Type: '.$fileInfo['type'] );

        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/files/'.$this->uri->segment(3) .'/'. $path['text']. $path['name'], true);
        echo $file;
    }

    public function upload()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');
        $this->load->helper('files');


        $folder_id = $_POST['folder_id'];

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        if ($this->isOwner('dir', $folder_id, $user['id'])!==true) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }


        if (empty($_FILES['Filedata']['name'])) {
            $reArrayFiles = rearrange($_FILES['file']);
        } else {
            $reArrayFiles = $_FILES;
        }

        foreach ($reArrayFiles as $file) {
            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/files/';

            $ext = explode('.', $file['name']);
            $dateTime = date('Y_m_d__h_i_s');
            $basename = md5_file($file['tmp_name']).'_'.$dateTime.'.'.$ext[count($ext)-1];
            $path = getPath($basename);

            $dirs_o = $uploaddir.'o/';
            $dirs_s = $uploaddir.'s/';
            foreach ($path['array'] as $key) {
                mkdir($dirs_o.$key); //TODO check dir exists
                mkdir($dirs_s.$key);

                $dirs_o .= $key.'/';
                $dirs_s .= $key.'/';
            }
            $uploadfile_o = $dirs_o . $basename;
            $uploadfile_s = $dirs_s . $basename;


            if (move_uploaded_file($file['tmp_name'], $uploadfile_o)) {

                $type = $this->getTypeByMIME(mime_content_type($uploadfile_o));

                $htaccess_data =
                    "Order allow,deny\nDeny from all";

                if ($type['primary']=='image') {
                    $new_image = new Pictures($uploadfile_o);
                    $new_image->percentimagereduce(10);
                    $new_image->imagesave($new_image->image_type, $uploadfile_s);
                    $new_image->imageout();

                    $htaccess_s = fopen($dirs_s.".htaccess", "w");
                    fwrite($htaccess_s, $htaccess_data);
                }

                $htaccess_o = fopen($dirs_o.".htaccess", "w");
                fwrite($htaccess_o, $htaccess_data);


                $name = $_POST['name'] ?? basename($_FILES['Filedata']['name']);

                $this->Model_files->uploadFile($basename, $user['id'], $type['full'], $folder_id, $name);


            } else {
                echo "<br>Возможная атака с помощью файловой загрузки!\n";
            }

            echo '<meta http-equiv="refresh" content="0;URL=/gallery/index/'.$folder_id.'">';
        }
    }

    public function addFolder ()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');
        $this->load->helper('files');


        $parent_id = $_POST['folder_id'];

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        if ($this->isOwner('dir', $parent_id, $user['id'])!==true) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }

        $new_folder_id = $this->Model_files->addFolder($_POST['name'], $user['id'], $parent_id);

        echo '<meta http-equiv="refresh" content="0;URL=/gallery/index/'.$new_folder_id.'">';
    }

    public function multi ()
    {

        switch ($this->uri->segment(3)) {
            case "delete":

                foreach ($_POST['checked'] as $key => $value){
                    if ($_POST['type'][$key]=='file') {
                        $this->deleteAction($key);
                    }
                    if ($_POST['type'][$key]=='folder') {
                        $this->deleteFolderAction($key);
                    }
                }

                echo '<meta http-equiv="refresh" content="0;URL=/">';
                break;
        }

    }

    public function delete ()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');
        $this->load->helper('files');

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        if ($this->isOwner('id', $this->uri->segment(3), $user['id'])!==true) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }

        $file = $this->Model_files->getOneFile('id', $this->uri->segment(3));

        $data['file'] = $file;
        $data['file']['path'] = getPath($data['file']['src']);


        $this->load->view('include/nav', $data);
        $this->load->view('include/header', $data);
        $this->load->view('delete', $data);
        $this->load->view('include/footer', $data);
    }

    public function deleteFolder ()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');
        $this->load->helper('files');

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        if ($this->isOwner('dir', $this->uri->segment(3), $user['id'])!==true) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }

        $file = $this->Model_files->getOneFile('id', $this->uri->segment(3));

        $data['file'] = $file;
        $data['file']['path'] = getPath($data['file']['src']);


        $this->load->view('include/nav', $data);
        $this->load->view('include/header', $data);
        $this->load->view('delete', $data);
        $this->load->view('include/footer', $data);
    }

    public function deleteAction ($file_id='')
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');

        if ($file_id=='') {
            $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

            if ($this->isOwner('id', $this->uri->segment(3), $user['id'])!==true) {
                header('HTTP/1.0 403 Forbidden');
                die();
            }

            $this->Model_files->delete($this->uri->segment(3));

            echo '<meta http-equiv="refresh" content="0;URL=/">';
        } else {
            $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

            if ($this->isOwner('id', $file_id, $user['id'])!==true) {
                header('HTTP/1.0 403 Forbidden');
                die();
            }

            $this->Model_files->delete($file_id);
        }

    }

    public function deleteFolderAction ($folder_id)
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');

        if ($folder_id=='') {
            $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

            if ($this->isOwner('dir', $this->uri->segment(3), $user['id'])!==true) {
                header('HTTP/1.0 403 Forbidden');
                die();
            }

            $this->Model_files->deleteFolder($this->uri->segment(3));

            echo '<meta http-equiv="refresh" content="0;URL=/">';
        } else {
            $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

            if ($this->isOwner('dir', $folder_id, $user['id'])!==true) {
                header('HTTP/1.0 403 Forbidden');
                die();
            }

            $this->Model_files->deleteFolder($folder_id);
        }

    }

    public function toggleFolderFree ()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        if ($this->isOwner('dir', $this->uri->segment(3), $user['id'])!==true) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }

        $folder = $this->Model_files->getOneFolder($this->uri->segment(3));

        if ($folder['free']) {
            $this->Model_files->toggleFolderFree($this->uri->segment(3), false);
        } else {
            $this->Model_files->toggleFolderFree($this->uri->segment(3), true);
        }

        echo '<meta http-equiv="refresh" content="0;URL=/">';
    }

    public function changeName ()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        if ($this->isOwner('id', $_POST['id'], $user['id'])!==true) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }

        $this->Model_files->updateName($_POST['id'], $_POST['value']);

        echo '<meta http-equiv="refresh" content="0;URL=/">';
    }

    public function changeDirName ()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        if ($this->isOwner('dir', $_POST['id'], $user['id'])!==true) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }

        $this->Model_files->updateDirName($_POST['id'], $_POST['value']);

        echo '<meta http-equiv="refresh" content="0;URL=/">';
    }

    public function getTypeByMIME ($mime)
    {
        $type = explode('/', $mime);

        // switch ($type[0]) {
        //     case 'text':
        //         return 'text';
        //     case 'image':
        //         return 'image';
        //     case 'video':
        //         return 'video';
        //     case 'application':
        //         return 'document';
        //     default:
        //         return 'document';
        // }

        $ret['primary'] = $type[0];
        $ret['sub']     = $type[1];
        $ret['full']    = $mime;

        return $ret;
    }
}

class Pictures {
    
    private $image_file;
    
    public $image;
    public $image_type;
    public $image_width;
    public $image_height;
    
    
    public function __construct($image_file) {
        $this->image_file=$image_file;
        $image_info = getimagesize($this->image_file);
        $this->image_width = $image_info[0];
        $this->image_height = $image_info[1];
        switch($image_info[2]) {
            case 1: $this->image_type = 'gif'; break;//1: IMAGETYPE_GIF
            case 2: $this->image_type = 'jpeg'; break;//2: IMAGETYPE_JPEG
            case 3: $this->image_type = 'png'; break;//3: IMAGETYPE_PNG
            case 4: $this->image_type = 'swf'; break;//4: IMAGETYPE_SWF
            case 5: $this->image_type = 'psd'; break;//5: IMAGETYPE_PSD
            case 6: $this->image_type = 'bmp'; break;//6: IMAGETYPE_BMP
            case 7: $this->image_type = 'tiffi'; break;//7: IMAGETYPE_TIFF_II (порядок байт intel)
            case 8: $this->image_type = 'tiffm'; break;//8: IMAGETYPE_TIFF_MM (порядок байт motorola)
            case 9: $this->image_type = 'jpc'; break;//9: IMAGETYPE_JPC
            case 10: $this->image_type = 'jp2'; break;//10: IMAGETYPE_JP2
            case 11: $this->image_type = 'jpx'; break;//11: IMAGETYPE_JPX
            case 12: $this->image_type = 'jb2'; break;//12: IMAGETYPE_JB2
            case 13: $this->image_type = 'swc'; break;//13: IMAGETYPE_SWC
            case 14: $this->image_type = 'iff'; break;//14: IMAGETYPE_IFF
            case 15: $this->image_type = 'wbmp'; break;//15: IMAGETYPE_WBMP
            case 16: $this->image_type = 'xbm'; break;//16: IMAGETYPE_XBM
            case 17: $this->image_type = 'ico'; break;//17: IMAGETYPE_ICO
            default: $this->image_type = ''; break;
        }
        $this->fotoimage();
    }
    
    private function fotoimage() {
        switch($this->image_type) {
            case 'gif': $this->image = imagecreatefromgif($this->image_file); break;
            case 'jpeg': $this->image = imagecreatefromjpeg($this->image_file); break;
            case 'png': $this->image = imagecreatefrompng($this->image_file); break;
        }
    }
    
    public function autoimageresize($new_w, $new_h) {
        $difference_w = 0;
        $difference_h = 0;
        if($this->image_width < $new_w && $this->image_height < $new_h) {
            $this->imageresize($this->image_width, $this->image_height);
        }
        else {
            if($this->image_width > $new_w) {
                $difference_w = $this->image_width - $new_w;
            }
            if($this->image_height > $new_h) {
                $difference_h = $this->image_height - $new_h;
            }
                if($difference_w > $difference_h) {
                    $this->imageresizewidth($new_w);
                }
                elseif($difference_w < $difference_h) {
                    $this->imageresizeheight($new_h);
                }
                else {
                    $this->imageresize($new_w, $new_h);
                }
        }
    }
    
    public function percentimagereduce($percent) {
        $new_w = $this->image_width * $percent / 100;
        $new_h = $this->image_height * $percent / 100;
        $this->imageresize($new_w, $new_h);
    }
    
    public function imageresizewidth($new_w) {
        $new_h = $this->image_height * ($new_w / $this->image_width);
        $this->imageresize($new_w, $new_h);
    }
    
    public function imageresizeheight($new_h) {
        $new_w = $this->image_width * ($new_h / $this->image_height);
        $this->imageresize($new_w, $new_h);
    }
    
    public function imageresize($new_w, $new_h) {
        $new_image = imagecreatetruecolor($new_w, $new_h);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $new_w, $new_h, $this->image_width, $this->image_height);
        $this->image_width = $new_w;
        $this->image_height = $new_h;
        $this->image = $new_image;
    }
    
    public function imagesave($image_type='jpeg', $image_file=NULL, $image_compress=100, $image_permiss='') {
        if($image_file==NULL) {
            switch($this->image_type) {
                case 'gif': header("Content-type: image/gif"); break;
                case 'jpeg': header("Content-type: image/jpeg"); break;
                case 'png': header("Content-type: image/png"); break;
            }
        }
        switch($this->image_type) {
            case 'gif': imagegif($this->image, $image_file); break;
            case 'jpeg': imagejpeg($this->image, $image_file, $image_compress); break;
            case 'png': imagepng($this->image, $image_file); break;
        }
        if($image_permiss != '') {
            chmod($image_file, $image_permiss);
        }
    }
    
    public function imageout() {
        imagedestroy($this->image);
    }
    
    public function __destruct() {
        
    }
    
}
?>
