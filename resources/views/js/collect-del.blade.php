<script>
    $(document).ready(function() {
        $('.btn-del-collect').click(function() {
            // 調用 sweetalert
            swal({
                title: "確定要取消收藏此商品嗎？",
                text: "確定要取消收藏此商品囉！",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是！含淚取消！",
                cancelButtonText: "{{__('Wait! Let me think again!')}}",
            }).then((result) => {
                if (result.value) {
                    swal("OK！取消收藏惹！", "該商品已經取消收藏了...", "success");
                    axios.delete('{{route('collect.destroy',$product->id)}}').then(function () {
                            setTimeout("location.href='{{ url()->full()}}'",1000)
                    });
                }
            });
        });
    });
</script>