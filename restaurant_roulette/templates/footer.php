<footer class="section">
    <div class="center grey-text">&copy; 2022 Ethan Zawada</div>
</footer>

<script>
    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(51.508742, -0.120850),
            zoom: 5,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqcsgmAUAbGyAb7NWkx9ThU2U9yRqheAM&callback=myMap"></script>
<script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
<script>
    var myVar;

    function ShowAndHide(el) {

        myVar = setTimeout(showPage, 2000);


        var element = el;
        element.remove();

        var z = document.getElementById('ready');
        z.remove();

    }

    function spinAgain() {
        location.reload();

    }

    function loading() {

        document.getElementById("loader").style.display = "block";

        myVar = setTimeout(showPage, 2500);

    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("roulette-hidden").style.display = "block";
    }

    function sideNav() {
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems, options);
        });
    }

    function dropDownHide() {
        var x = document.getElementById("hiddenFilters");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function checkAllCuisine(source) {
        checkboxes = document.getElementsByName('cuisineCheck[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function priceCheckAll(source) {
        checkboxes = document.getElementsByName('priceCheck[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>