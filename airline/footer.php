 <!-- jQuery CDN -->
 <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
 
 <script>$(document).ready(()=>{
                $('#flydet').hide();
                $('#person1').hide();
                $('#person2').hide();
                $('#person3').hide();
                $('#person4').hide();
                $('#person_count').keyup(()=>{
                    let no_of_person=$('#person_count').val();
                    console.log(no_of_person);
                    if(no_of_person==2){
                                
                                $('#person1').show(2000);
                    }
                    else if(no_of_person==3){
                                
                                $('#person1').show(2000);
                                $('#person2').show(2000);
                    }
                    else if(no_of_person==4){
                                
                                $('#person1').show(2000);
                                $('#person2').show(2000);
                                $('#person3').show(2000);
                    }
                    else if(no_of_person==5){
                                
                                $('#person1').show(2000);
                                $('#person2').show(2000);
                                $('#person3').show(2000);
                                $('#person4').show(2000);
                    }
                })
                $('#btn_flydet').click(()=>{
                    $('#flydet').show();
                })
            })

</script>
 
 
 
 
 <!-- CODE FOR AJAX -->
<script src="https://kit.fontawesome.com/f0a39ee957.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
</script>
<script src="js/scripts.js"></script>
<?php if (isset($_SESSION["status"]) && $_SESSION["status"] != "") : ?>
    <script>
        Swal.fire({
            icon: '<?= $_SESSION["status_code"] ?>',
            title: '<?= $_SESSION["message"] ?>',
            text: '<?= $_SESSION["status"] ?>',
        }).then(function() {
            window.location = "<?= $_SESSION["page"] ?>";
        });
    </script>
    <?php unset($_SESSION["status"]); ?>
<?php endif ?>
</body>
</html>