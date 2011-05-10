<?php include('logic.php');?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Violetta - Solution for deploying PHP applications</title>
</head>

<body>
    <h1>Violetta &mdash; deploy scripts generator</h1><h3>Solution for deploying PHP applications</h3>
    <hr/>
    <form method="POST" action="index.php">
        <fieldset>
            <legend>Copy from</legend>
            
            <label>Database:</label>
            <input type="text" name="from_db_name" value="" />
            <br/>
            <label>Database user:</label>
            <input type="text" name="from_db_user" value="root" /> 
            <br/>
            <label>Database password:</label>
            <input type="text" name="from_db_pass" value="root" />
            <br/>
            <br/>
            
            <label>Paths to pack&amp;copy:</label>
            <input type="text" name="from_paths" value="" />  

        </fieldset>        

        <fieldset>
            <legend>Copy to</legend>
            <label>Server:</label>
            <input type="text" name="to_db_name" value="" />
            <br/>
            <label>User:</label>
            <input type="text" name="to_db_user" value="" /> 
            <br/>
            <label>Password:</label>
            <!--input type="text" name="to_db_pass" value="" /-->
            <br/>
            <br/>
             
            <label>Src path:</label>
            <input type="text" name="to_src_path" value="" />
            <br/>
            <label>Cache dirs to clear after deploying:</label>
            <input type="text" name="to_cache_dir" value="" /> 
        </fieldset>         
        <input type="hidden" name="action" value="generate" />  
        <input type="submit" name="send" value="Generate" />
    </form>
</body>    
</html>
