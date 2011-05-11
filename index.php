<?php include('logic.php');?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Violetta - Solution for deploying PHP applications</title>
    <style>
        body{
            font-family: Arial, Tahoma;
            color: #fff;
            background: #333;
        }
        fieldset {
            border: 1px solid #657;
            padding:20px;
            margin: 20px;
            border-radius: 10px;
        }
        legend {
            padding: 0 15px;
            color: #dbe
        }
        h1 {
           color: #98b  
        }   
        h1 span {
           color: #dbe       
        }
        label, input{
            width:180px;
            display: block;
            float: left;
        }
        input {
            width:300px;
            border: 1px solid #657;
            border-radius:5px;
            color: #fff;
            background: #555;
            padding: 3px 3px;
        }
        input.button {
            width:auto;
            border: 1px solid #435;
            border-radius:5px;
            color: #fff;
            background: #657;
            padding: 5px 25px;
            cursor: pointer;
            margin-left: 20px;
            font-size: 18px;
        } 
        br {
            clear: both;    
        }
        hr {
            border: medium none;
            border-top: 1px solid #888;
        }
            
    </style>
</head>

<body>
    <h1><span>Violetta</span> &mdash; deploy script generator</h1><h3>Solution for deploying PHP applications</h3>
    <hr/>
    <form method="POST" action="index.php">
        <fieldset>
            <legend>Copy from</legend>
            
            <label>Database:</label>
            <input type="text" name="from_db_name" value="<?=$from_db_name?>" />
            <br/>
            <label>Database user:</label>
            <input type="text" name="from_db_user" value="<?=$from_db_user;?>" /> 
            <br/>
            <label>Database password:</label>
            <input type="text" name="from_db_pass" value="<?=$from_db_pass;?>" />
            <br/>
            <br/>
            
            <label>Paths to pack&amp;copy:</label>
            <input type="text" name="from_paths" value="<?=$from_paths;?>" />  

        </fieldset>        

        <fieldset>
            <legend>Copy to</legend>
            <label>Database:</label>
            <input type="text" name="to_db_name" value="<?=$to_db_name;?>" />
            <br/>
            <label>Database user:</label>
            <input type="text" name="to_db_user" value="<?=$to_db_user;?>" /> 
            <br/>
            <label>Database password:</label>
            <input type="text" name="to_db_pass" value="<?=$to_db_pass;?>" />
            <br/>
            <br/>
 
            <label>Server:</label>
            <input type="text" name="to_server" value="<?=$to_server;?>" />
            <br/>
            <label>User:</label>
            <input type="text" name="ssh_user" value="<?=$ssh_user;?>" /> 
            <br/>
            <br/>
             
            <label>Src path:</label>
            <input type="text" name="to_src_path" value="<?=$to_src_path;?>" />
            <br/>
            <label>Cache dirs to clear after deploying:</label>
            <input type="text" name="to_clear_dir" value="<?=$to_clear_dir;?>" /> 
            <br/>
            <br/>
            <label>Git Branch:</label>
            <input type="text" name="to_git_branch" value="<?=$to_git_branch;?>" />  
        </fieldset>         
        <fieldset>
            <legend>Environment</legend>
            
            <label>Save script to:</label>
            <input type="text" name="env_save_to" value="../" />
            
        </fieldset>        
      
        <input type="hidden" name="action" value="generate" />  
        <input class="button" type="submit" name="send" value="Generate script" />
    </form>
</body>    
</html>
