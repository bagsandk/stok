<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Transaksi Penjualan</title>
    <!-- pop up jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <!-- end pop up jquery-->


    <!-- pop up windows-->
    <script>
        function PopupCenter(pageURL, title, w, h) {
            //var left = (screen.width/2)-(w/2);
            //var top = (screen.height/2)-(h/2);
            var targetWin = window.open
            //(pageURL, title, 'toolbar=no, alwaysraised=yes, fullscreen=true location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=screen.availWidth.MAX_VALUE, height=screen.availHeight.MAX_VALUE, top='+top+', left='+left);
            (pageURL, title, 'toolbar=no, alwaysraised=' + 1 + ', fullScreen=no, locationbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=screen.availWidth.MAX_VALUE, height=screen.availHeight.MAX_VALUE, top=0, left=0');
            this.targetWin.focus();
        }
    </script>
</head>

<body>
    <img src="<?= base_url('assets/img/0003-BAAK-IV-2021') ?>.png" />
</body>

</html>