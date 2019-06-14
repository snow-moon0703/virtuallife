<script>
    $(document).ready(function() {
        $('.btn-creator').click(function() {
            // 獲取按鈕上 data-id 屬性的值，也就是編號
            var id = $(this).data('id');
            var priority =$(this).data('priority');
            // 調用 sweetalert
            if(priority=="T"){
                swal({
                title: "{{__('Are you sure you want to stop the user?')}}",
                text: "{{__('After the suspension, the user will disable the creator function!')}}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是！將該用戶停權！",
                cancelButtonText: "{{__('Wait! Let me think again!')}}",
                }).then((result) => {
                    if (result.value) {
                        swal("OK！停權用戶惹！", "該用戶已經鎖定權限了...", "success");
                        axios.patch('/admin/creator/'+id+'/patch').then(function () {
                            location.reload();
                        });
                    }
                });
            }else{
                swal({
                title: "確定要恢復該用戶嗎？",
                text: "恢復後該用戶就將啟用創作者功能囉！",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是！確認恢復！",
                cancelButtonText: "{{__('Wait! Let me think again!')}}",
                }).then((result) => {
                    if (result.value) {
                        swal("OK！恢復用戶惹！", "該用戶已經啟用創作者功能了...", "success");
                        axios.patch('/admin/creator/'+id+'/patch').then(function () {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
</script>