<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="text" name="shu" id="a"> 
    <input type="text" name="shu" id="b"> 
    <button id="niu">结果</button> 
</body>
</html>
<script src="/index/js/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).on("click","#niu",function(){
            var shu =$(this).siblings("#a").val();
            var zhi =$(this).siblings("#b").val();
            
            $.ajax({
                    url: "/create",
                    type: "get",
                    data: {
                        shu: shu,
                        zhi: zhi
                    },
                    success: function(res) {
                        
                    }
            })
    })
</script>