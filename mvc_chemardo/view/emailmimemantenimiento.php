<?php require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
 require("layout/header.php"); ?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script src="view/js/textarea.js"></script>
<h1>Email Mime</h1>
    <div class="panel">
        <form action="<?php echo URLSITE; ?>?c=email&m=enviarmime" method="POST" enctype="multipart/form-data">
        <label for="to" class="form-label">To:</label>
        <input type="text" class="form-control" name="to" id="to" 
        value="" required />
        <br>
        <label for="cc" class="form-label">CC:</label>
        <input type="text" class="form-control" name="cc" id="cc" 
        value=""/>
        <br>
        <label for="bcc" class="form-label">BCC:</label>
        <input type="text" class="form-control" name="bcc" id="bcc" 
        value=""/>
        <br>
        <label for="subject" class="form-label">Subject:</label>
        <input type="text" class="form-control" name="subject" id="subject" 
        value="" required/>
        <br>
        <label for="message" class="form-label">Message:</label>
        <textarea type="text" class="form-control" name="message" id="message" 
        value=""></textarea>
        <br>
        <label for="fichero" class="form-label">Adjuntar archivo</label>
        <input type="file" name="fichero" id="fichero">
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Aceptar</button>

        </form>
    </div>
<?php require("layout/footer.php"); ?>