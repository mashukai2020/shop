<center>
<h1>抽奖</h1>
<button id="clk">抽奖
</button>
</center>
<script  src="/index/js/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).on("click","#clk",function(){
        // alert(2222);
        if(confirm('您确定要抽奖吗')){
        $.get(
            '/chou/yunqi',
            function(size){
            if(size.code=='00000'){
                    alert(msg);
            }
        },'json');
        }
	})

</script>
