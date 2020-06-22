<?php
class Upload {
    private $upload_path;
    private $allowed_types;
    private $max_size;
    private $max_width;
    private $max_height;

    public $nombre_archivo_subido_original;
    public $extension_imagen;
    public $nombre_archivo_subido;

    public function __construct($config=[])
        {
            $this->upload_path = $config["upload_path"];
            $this->allowed_type = $config["allowed_type"];
            $this->max_size = $config["max_size"];
            //$this->max_width = $config["max_width"];
            //$this->max_height = $config["max_height"];
        }

    public function do_upload($file){
        $this->nombre_archivo_subido_original = $file["name"];
        $target_file = $this->upload_path . basename($file["name"]);
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $md5_name = md5_file($file["tmp_name"]).time();
        $this->nombre_archivo_subido = $md5_name . '.' . $imageFileType;
        $this->extension_imagen = $imageFileType;
        $ruta_name_archivo_subido = $this->upload_path . $this->nombre_archivo_subido;
        // Check if image file is a actual image or fake image
        //if(isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }
        //}
        // Check if file already exists
        if (file_exists($ruta_name_archivo_subido)) {
            //echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($file["size"] > $this->max_size) {
            //echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if(!in_array($imageFileType,$this->allowed_type)){
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            return FALSE;
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], __BASE__.$ruta_name_archivo_subido)) {
                //echo "The file ". basename( $file["name"]). " has been uploaded.";
                //echo site_url($ruta_name_archivo_subido);
            } else {
                //echo "Sorry, there was an error uploading your file.";
                return FALSE;
            }
        }

        return TRUE;

    }
}