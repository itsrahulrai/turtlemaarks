<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title><?= htmlspecialchars($title ?? 'Turtle Maarks Hearing Health - Hearing Aid supplier of all leading brands') ?></title>
    <meta name="google-site-verification" content="ahiVUWelvmK2tICsQppULgxTOop8f5EwM7-D3aJaDnQ" />
    <meta name="description" content="<?= htmlspecialchars($description ?? '') ?>">
    <meta name="keywords" content="<?= htmlspecialchars($keywords ?? '') ?>">
    <meta name="robots" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= htmlspecialchars('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">


    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awsome-all.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Turtle Maarks Hearing Health",
  "image": "https://turtlemaarks.com/assets/images/logo.png",
  "@id": "https://www.google.com/maps/place/Turtle+Maarks+Hearing+Health/@28.6057935,77.4299678,17z/data=!4m6!3m5!1s0x390cef575eaa2019:0x13228af08a69d9af!8m2!3d28.6057935!4d77.4299678!16s%2Fg%2F11ss4wz6q4?entry=ttu&g_ep=EgoyMDI2MDgxNy4wIKXMDSoASAFQAw%3D%3D",
  "url": "https://share.google/yjX6IHjYg8WoH0eWC",
  "telephone": "8130495476",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "15th floor, gaur city mall, 1509, Greater Noida W Rd, Gaur City 1, Sector IV, Sector 4, Noida, Ghaziabad",
    "addressLocality": "Uttar Pradesh",
    "postalCode": "201306",
    "addressCountry": "IN"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 28.6057935,
    "longitude": 77.4299678
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "10:00",
    "closes": "20:00"
  },
  "sameAs": [
    "https://www.facebook.com/turtlemaarks/",
    "https://www.instagram.com/turtlemaarks_hearinghealth/",
    "https://www.youtube.com/@TurtleMaarksHearingHealth",
    "https://in.linkedin.com/company/turtle-maarks-hearing-health",
    "https://turtlemaarks.com/"
  ] 
}
</script>

</head>

<body>

    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book Your Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="row justify-content-center">
                    <div class="p-3" style="max-width:auto;">
                        <div class="modal-body">
   <form action="send_mail.php" method="POST">
        <div class="row">
            <div class="col-12 mb-3">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="col-12 mb-3">
                <input type="tel" name="phone" class="form-control" placeholder="Phone No" required>
            </div>
            <div class="col-12 mb-3">
                <select name="service" class="form-control" required>
                    <option value="">Select Service</option>
                    <option value="Diagnostic Services">Diagnostic Services</option>
                    <option value="Products">Products</option>
                    <option value="Repair">Repair</option>
                </select>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-danger">Book Now</button>
            </div>
        </div>
    </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>





    <!-- Header Area Start Here -->
    <?php require_once('include/header.php'); ?>
    <!-- Header Area End Here -->
    <!-- Booking Modal -->



    <?= $content ?>


    <!-- Footer Area Start Here -->
    <?php require_once('include/footer.php'); ?>
    <!-- Footer Area End Here -->
    
        <a href="https://wa.me/+918130495476" class="float" target="_blank">
    <i class="icofont-whatsapp my-float"></i>
    </a>
    


    <script>window.$zoho=window.$zoho || {};$zoho.salesiq=$zoho.salesiq||{ready:function(){}}</script>
    <script id="zsiqscript" src="https://salesiq.zohopublic.in/widget?wc=siq82a24f1418b7ee4def6296b6265421285e7ec1a8c75811c95c4672268dc854aa" defer></script>
   

    <!-- Javascript Files -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/slick.min.js"></script>
    <script src="assets/js/vendor/counterup.min.js"></script>
    <script src="assets/js/vendor/jquery.meanmenu.min.js"></script>
    <script src="assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="assets/js/vendor/waypoints.min.js"></script>
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/vendor/easing.min.js"></script>
    <script src="assets/js/vendor/wow.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>