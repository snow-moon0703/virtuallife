<script>
    $(document).ready(function() {
        $('.btn-del-article').click(function() {
            var id = $(this).data('id');
            swal({
                title: "{{ __('Are you sure you want to delete the article?') }}",
                text: "{{__('After the deletion, the article will not be saved!')}}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{__('Yes! With tears deleted!')}}",
                cancelButtonText: "{{__('Wait! Let me think again!')}}",
            }).then((result) => {
                if (result.value) {
                    swal("OK！刪掉文章惹！", "該文章已經隨風而逝了...", "success");
                    axios.delete('/article/'+id+'/delete').then(function () {
                        location.href='/article';
                    });
                }
            });
        });
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