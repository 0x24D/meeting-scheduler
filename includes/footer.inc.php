</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
var i = 1;
$(".fa-plus-circle").click(function() {
    i++;
    var aDiv = document.createElement("div");
    aDiv.innerHTML = '<input type="text" class="form-control" name="attendee'+i+'" required>';
    document.getElementById("a").appendChild(aDiv);
});
</script>
</body>
</html>
