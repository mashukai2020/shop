<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach($myArray as $v)
       <button name="dian"  id="add" value="{{$v}}">{{$v}}</button>
    @endforeach
</body>
</html>
<script  src="/index/js/plugins/jquery/jquery.min.js"></script>
<script>
$(document).on('click','#add',function(){
    // alert(1);
    _this =$(this);
    var name=_this.attr('name');
    var id =_this.attr("value");
    if(confirm('您确定要购买吗')){
        $.get(
            '/dian/create/'+id,
            {id:id}
        )
        }

})

</script>