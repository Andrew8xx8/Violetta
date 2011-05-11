<?php
function stringToShArray($name, $string, $delim){
    $script = '';
    $items = explode($delim, $string);
    for ($i = 0; $i < count($items); $i++) {
        if ($i == 0 )
            $script .= $name.'=\'';
        $script .= trim($items[$i]);
        if ($i == count($items) - 1)
            $script .= "'\n";
        else
            $script .= ' ';
    } 
    return $script;
}
$params = Array();
foreach($_REQUEST as $k=>$param)
        $params[$k] = mysql_escape_string($param);

if (@$params['action']=='generate') {
    $script = "";

    $script.="
FROM_DB_NAME='{$params['from_db_name']}'
FROM_DB_PASS='{$params['from_db_pass']}' 
FROM_DB_USER='{$params['from_db_user']}'

"; 

    if (!empty($params['from_paths'])){
        $script .= stringToShArray('FROM_PATHS',$params['from_paths'],';');
    }

    $script.="
TO_DB_NAME='{$params['to_db_name']}'
TO_DB_PASS='{$params['to_db_pass']}' 
TO_DB_USER='{$params['to_db_user']}'    

SSH_USER='{$params['ssh_user']}'

TO_SERVER_NAME='{$params['to_server']}'
TO_PATH='{$params['to_src_path']}'

BRANCH='{$params['to_git_branch']}'
"; 

    if (!empty($params['to_clear_dir'])){
        $script .= stringToShArray('CLEAR_PATHS',$params['to_clear_dir'],';'); 
    }
    if ($params['env_save_to']) {
        $file =  file_get_contents("deploy.sh.tpl");
        $file = preg_replace("#\{\{PARAMS\}\}#", $script, $file);
    
        $shell_file = fopen($params['env_save_to'].'deploy.sh', "wt+");  
        fwrite( $shell_file , $file); 
        fclose($shell_file);
    }
    $settings_file = fopen('settings.php', "wt+");  
    fwrite( $settings_file , "<?php ");
    foreach($params as $k=>$param) {       
        fwrite( $settings_file , "$".$k."='".$param."';");        
    } 
    fwrite( $settings_file , " ?> "); 
    fclose($settings_file); 
        
}
include('settings.php');

?>
