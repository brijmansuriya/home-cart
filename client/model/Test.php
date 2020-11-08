<html>
<script>
    var init = 0;
    var limit = 10;

    var flag = 0;
</script>
<body>
    
    <table border=1 id='tbl'>
        
    </table>

    <button value='1' onclick="FisrtRecords()">First</button>
    <button value='' onclick="Prev()">Previous</button>
    <button value='' onclick="Next()">Next</button>
    <button value='10'>Last</button>
</body>
</html>

<script type="text/javascript" src="../../vendor/jquery/jquery-3.2.1.min.js"></script>
<!-- <script type="text/javascript" src="../../assets/js/Assert.js"></script> -->

<script>
    function ControlGenerator(TargetFilePath,Method,Data){
        var t = ($.ajax({
            method:Method,
            url : TargetFilePath,
            data : Data,
            processData : false,
            contentType : false,
            global : false,
            async : false
        }));       

        return t.responseText;
    }    

    function Next(){
        
        if (flag == 1 && init == 0){
            init = 10;
        }
        
        var data = new FormData();
        data.append('action','tbl')
        data.append('from',init);
        data.append('to',limit);
        $('#tbl').html(ControlGenerator('Test1.php','POST',data));
        console.log("From :" + init + " To :" + limit);
        console.log(flag);
        flag = 1;
        init +=10;
        
    }

    function Prev(){

        init = init - 10;

        if (flag == 0){
            init = 0;
            return;
        }  

        if (flag == 1 && init <= 0){
            init = 0;
            return;
        }
        
        var data = new FormData();
        data.append('action','tbl')
        data.append('from',init);
        data.append('to',limit);
        $('#tbl').html(ControlGenerator('Test1.php','POST',data));
        console.log("init :" + init + " limit :" + limit);
        console.log(flag);
        flag = 1;
    }
    
</script>

