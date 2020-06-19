<?php
class Validar{
    function getValidados($data = []){
        //if ($data&&$this->check_all_empty($data))
        if ($data)
        {
            $validados=[];if ((gettype($data)=="array") OR (gettype($data)=="object"))
            {
                foreach ($data as $key => $value) {
                    if (is_array($value))
                        $validados[$key] = $this->getValidados($value);
                        else
                        $validados[$key] = $this->test_input($value);
                }
            }else
                $validados = $this->test_input($data);
            return $validados;
        }
        else
            return false;
        return null;
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function check_all_empty($data){
        if ((gettype($data)=="array") OR (gettype($data)=="object"))
        {
            foreach ($data as $key => $value)
            {
                if (empty($value))
                    return FALSE;
            }
        }elseif (empty($data))
            return FALSE;
        return TRUE;

    }
    public function check_empty($data, $fields)
    {
        foreach ($fields as $value) {
            if (empty($data[$value])) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function is_age_valid($age)
    {
        //if (is_numeric($age)) {
        if (preg_match("/^[0-9]+$/", $age)) {
            return true;
        }
        return false;
    }

    public function is_email_valid($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    public function is_url($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // Validate url
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            //echo("$url is a valid URL");
            return TRUE;
        } else {
            //echo("$url is not a valid URL");
            return FALSE;
        }
    }
    public function is_url_with($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // Validate url
        if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED)) {
            //echo("$url is a valid URL");
            return TRUE;
        } else {
            //echo("$url is not a valid URL");
            return FALSE;
        }
    }
}
?>