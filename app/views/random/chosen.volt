{{ content() }}

<div class="row">
        <div class="well">
            <h3>Millipede</h3>
            <p id="millipede"></p>
            <script type="text/javascript">

                var millipede = JSON.stringify({{millipede}}),
                    myObj = JSON.parse(millipede),
                    txt = "";

                txt += "<table border='1' style='text-align: center'>"
                for (x in myObj) {
                    txt += "<tr><td> >>>>> " + myObj[x].email  + '   >>>>>' + "</td></tr>";
                }
                txt += "</table>"
                document.getElementById("millipede").innerHTML = txt;
            </script>
        </div>
</div>
</div>