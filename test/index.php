<script src="/lib/cropper/cropper.js"></script>
<link  href="/lib/cropper/cropper.css" rel="stylesheet">

<div>
  <img id="image" src="/noexec/byung1.jpg">
</div>

<btn class="btn btn-primary"> Get Cropped </btn>

<script>
  var image = document.getElementById('image');
  var cropper = new Cropper(image, {
    aspectRatio: 16 / 9,
    crop: function(event) {
      console.log(event.detail.x);
      console.log(event.detail.y);
      console.log(event.detail.width);
      console.log(event.detail.height);
      console.log(event.detail.rotate);
      console.log(event.detail.scaleX);
      console.log(event.detail.scaleY);
    }
  });
</script>
