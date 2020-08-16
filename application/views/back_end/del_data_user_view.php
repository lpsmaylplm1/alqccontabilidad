

<div class="row"style="max-height: 550px;overflow-y: scroll;">
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content" >
                <input type="hidden" name="id_user_del" id="id_user_del" value="<?php echo $id_user ?>" />


                <div class="alert" style="font-size: 15px; text-align: center;  color:black" id="confirm_del">
                    <i class="fa fa-user fa-3x"></i> 
                    <p style="font-weight: bold">¿Confirma que desea eliminar permanentemente este usuario?</p>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar Eliminación</button>
                    <button type="button" class="btn btn-success" id="btn_del_user"><i class="fa fa-trash"></i> Eliminar Usuario</button>
                </div>
                <div class="x_content" >
                </div>
                <div class="col-md-12 col-sm-9 col-xs-12 " style="text-align: center">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            base_url = "<?php echo base_url(); ?>";
 //        $("#icon_del_pub").hide();
        });
        $('#btn_del_user').click(function () {
            URL = base_url + "usuarios/confirm_del_user";
            var id_user = $('#id_user_del').val();
            $("#icon_del_pub").show();
            $.ajax({
                type: "POST",
                url: URL,
                data: 'id_user=' + id_user,
                dataType: "html",
 //            beforeSend: function () {
 //                $("#confirm_del").empty();
 //            },
                success: function (data) {
 //                $("#icon_del_pub").hide();
                    $("#confirm_del").empty();
                    $('#confirm_del').html(data);
                    setTimeout(function () {
                        location.href = base_url + "usuarios";
                    }, 1000);
                }
            });
        });
    </script>