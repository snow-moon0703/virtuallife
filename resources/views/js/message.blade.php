<script>
    $(document).ready(function() {
        $('.btn-del-message').click(function() {
            var id = $(this).data('id');
            swal({
                title: "{{__('Are you sure you want to delete the message?')}}",
                text: "{{__('After the deletion, the message will not be saved!')}}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{__('Yes! With tears deleted!')}}",
                cancelButtonText: "{{__('Wait! Let me think again!')}}",
            }).then((result) => {
                if (result.value) {
                    swal("OK！刪掉留言惹！", "該留言已經隨風而逝了...", "success");
                    axios.delete('/message/'+id+'/delete').then(function () {
                        location.reload();
                    });
                }
            });
        });
    });

</script>