
        <!-- Bootstrap core JS-->
        <script
            src="<?php echo $sources['bootstrap_js']; ?>"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

    </body>
</html>

<?php 
// mensajes
if (isset($_SESSION['message'])) {
    echo '<script>alert("' . $_SESSION['message'] . '")</script>';
    unset($_SESSION['message']);
}
?>