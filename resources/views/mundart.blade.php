@extends('layouts.app')

@section('title', 'Wäller Platt ')

@section('content')
  <div class="container">
   <article class="hero-section"><h1>Wäller Platt - Wo es gesprochen wird</h1></article>

    <div id="main">


      <h3>Der Dialekt</h3>
      <article>

        <p>
          Der hier vorgestellte Dialekt, in der Gegend des Westerwaldes &quot;Platt&quot; genannt, stammt hinsichtlich
          seiner Ausprägung und Aussprache aus dem kleinen Örtchen Hirschberg, das am Ostrand des Westerwaldes gelegen
          ist. Dieser Dialekt geht weit über die hier gezogene rote Grenze hinaus, zeigt dann aber zahlreiche Abweichungen
          und Lautverschiebungen. Gleichwohl verstehen sich die Eingeweihten aus Westerwald und Hinterland. </p>


      </article>
      <article class="grid">
        <p>Der Dialekt des östlichen Westerwaldes, das Wäller Platt,
          liegt in dem Gebiet, in dem Mitteldeutsch gesprochen wird, wie die
          nachfolgende Karte zeigt:</p>

        <img id="myImg" src="images/dialekt.gif" alt="Dialekt" style="width:100%;max-width:300px">

        <!-- The Modal -->
        <div id="myModal" class="modal">

          <!-- The Close Button -->
          <span class="close">&times;</span>

          <!-- Modal Content (The Image) -->
          <img class="modal-content" id="img01">
        </div>

      </article>
      <article class="grid">
        <p>Innerhalb der Gruppe der mitteldeutschen Dialekte handelt es sich um ein Mischgebiet an der Grenze zwischen
          Hessisch (Mittelhessisch) und
          Moselfränkisch. Es stellt aber ein eigenstäniges Gebiet ohne genauere
          Bezeichnung dar. Die folgende Karte zeigt das genauer:</p>
        <img id="myImg2" src="images/deutdig2.jpg" alt="Dialekte in Deutschland" style="width:100%;max-width:300px">

        <!-- The Modal -->
        <div id="myModal2" class="modal">

          <!-- The Close Button -->
          <span class="close">&times;</span>

          <!-- Modal Content (The Image) -->
          <img class="modal-content" id="img02">
        </div>

      </article>



      <!-- InstanceEndEditable -->
    </div>
    <style>
      #myImg,
      #myImg2 {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
      }

      #myImg,
      #myImg2:hover {
        opacity: 0.7;
      }

      /* The Modal (background) */
      .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
      }

      /* Modal Content (Image) */
      .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
      }

      /* Caption of Modal Image (Image Text) - Same Width as the Image */
      #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
      }

      /* Add Animation - Zoom in the Modal */
      .modal-content,
      #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
      }

      @keyframes zoom {
        from {
          transform: scale(0)
        }

        to {
          transform: scale(1)
        }
      }

      /* The Close Button */
      .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
      }

      .close:hover,
      .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
      }

      /* 100% Image Width on Smaller Screens */
      @media only screen and (max-width: 700px) {
        .modal-content {
          width: 100%;
        }
      }
    </style>
    <script>// Get the modal
      var modal = document.getElementById("myModal");

      // Get the image and insert it inside the modal - use its "alt" text as a caption
      var img = document.getElementById("myImg");
      var modalImg = document.getElementById("img01");
      var captionText = document.getElementById("caption");
      img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
      }
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
        modal.style.display = "none";
      } </script>
    <script>
      // Get the modal
      var modal = document.getElementById("myModal2");

      // Get the image and insert it inside the modal - use its "alt" text as a caption
      var img = document.getElementById("myImg2");
      var modalImg = document.getElementById("img02");
      var captionText = document.getElementById("caption");
      img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
      }
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[1];

      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
        modal.style.display = "none";
      } </script>

@endsection