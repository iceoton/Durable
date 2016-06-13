<!-- Modal Edit -->
<div class="modal fade" id="edit_member_group" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form id="form2" name="form2" method="post">
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">ปิด</span></button>
                    <h4 class="modal-title" id="memberModalLabel">แก้ไขข้อมูลกลุ่มของสมาชิก</h4>
                </div>
                <div class="ct">
              
                </div>
            </div>
        </div>
  </form>
</div>



<a data-toggle="modal" data-target="#edit_member_group" data-whatever="<?php echo @$showcat->grp_key;?>" class="btn btn-xs btn-info" style="color:#FFF;"><i class="fa fa-edit fa-fw"></i> <?php echo @LA_BTN_EDIT;?></a>



<script>
    $('#edit_member_group').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/edit_member_group.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.ct').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });  
    })
    </script>