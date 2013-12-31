<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script charset="utf-8" src="./kindeditor.js"></script>
        <script charset="utf-8" src="./lang/zh_CN.js"></script>
        <script>
            var editor;
            KindEditor.ready(function(K) {
                editor = K.create('#editor_id');
            });
            function asd(){
                var  html = document.getElementById('editor_id').value; // 原生API
                // 取得HTML内容
                html = editor.html();

                // 同步数据后可以直接取得textarea的value
                editor.sync();
                html = document.getElementById('editor_id').value; // 原生API
                alert(html);
            }
        </script>
    </head>
    <body>
        <textarea id="editor_id" name="content" style="width:700px;height:300px;">
        </textarea>
        <input type="button" name="as" id="as" value="1234"  onclick="asd()"/>
    </body>
</html>
