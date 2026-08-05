<?php 
function upload_file($file, $destination,$id){
    $result = array();

    if (empty($file['name'])) {
        $result['message'] = "No file uploaded.";
        return $result;
    }

    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $file_partname = explode('.', $file_name)[0];


    $extensions = array('jpeg', 'jpg', 'png', 'pdf', 'jfif', 'pptx', 'xlsx');

    // $extensions = array('pdf', 'pptx', 'xlsx');

    if (!in_array($file_ext, $extensions)) {
        $result['message'] = "Extension not allowed, please choose a PDF file Only.";
        return $result;
    }

    // if ($file_size > 5000000) {
    //     $result['message'] = 'File size must be exactly 2 MB or less.';
    //     return $result;
    // }

    $timestamp = date('Y-m-d');
    $file_name_with_date =  $timestamp . "-" . str_replace("'", "`", $file_partname) . $id . "." . $file_ext;
    $path = $destination . "/" . $file_name_with_date;
    $result['result'] = move_uploaded_file($file_tmp, $path);
    $result['path'] = $path;

    return $result;
}



?>