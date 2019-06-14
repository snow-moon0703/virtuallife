<script>
    $(document).ready(function() {
        $('.btn-add-collect').click(function() {
            swal({
                title: "{{__('Are you sure you want to keep this item?')}}",
                text: "{{__('Be sure to collect this item!')}}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{__('Yes!Collect this item!')}}",
                cancelButtonText: "{{__('Wait! Let me think again!')}}",
            }).then((result) => {
                if (result.value) {
                    swal("OK！收藏商品惹！", "該商品已經收藏了...", "success");
                    axios.post('{{route('collect.store',$product->id)}}').then(function () {
                            setTimeout("location.href='{{ url()->full()}}'",1000)
                    });
                }
            });
        });
    });
</script>