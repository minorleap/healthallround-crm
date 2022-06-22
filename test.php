<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap - Prebuilt Layout</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  </head>
  <body>
	  <?php include("includes/navigation.php"); ?>
	  
	  

    <div class="jumbotron jumbotron-fluid text-center">
       <h1 class="display-4">Bootstrap with Dreamweaver</h1>
       <p class="lead">Easily build your page using the Bootstrap components from the Insert panel.</p>
       <hr class="my-4">
       <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
       <p class="lead">
          <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
       </p>
    </div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	  
	  
    <div class="container">
       <div class="row text-center">
          <div class="col-lg-6 offset-lg-3">Click outside the blue container to select this <strong>row</strong>. Columns are always contained within a row. <strong>Rows are indicated by a dashed grey line and rounded corners</strong>. </div>
       </div>
       <br>
       <hr>
       <br>
       <div class="row">
          <div class="col-md-4">
             <div class="card">
                <img class="card-img-top" src="../images/card-img.png" alt="Card image cap">
                <div class="card-body">
                   <h4 class="card-title">Card title</h4>
                   <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                   <br><br>
                   <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
             </div>
          </div>
          <div class="col-md-4">
             <div class="card">
                <div class="card-body">
                   <h5 class="card-title">Card title</h5>
                   <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                   <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                   <a href="#" class="card-link">Card link</a>
                   <a href="#" class="card-link">Another link</a>
                </div>
             </div>
             <br>
             <br/>
             <div class="card">
                <div class="card-header">
                   Featured
                </div>
                <ul class="list-group list-group-flush">
                   <li class="list-group-item">Cras justo odio</li>
                   <li class="list-group-item">Dapibus ac facilisis in</li>
                   <li class="list-group-item">Vestibulum at eros</li>
                </ul>
             </div>
          </div>
          <div class="col-md-4">
             <div class="card">
                <img class="card-img-top" src="../images/card-img.png" alt="Card image cap">
                <div class="card-body">
                   <h5 class="card-title">Card title</h5>
                   <p class="card-text">Some text to build on the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                   <li class="list-group-item">Cras justo odio</li>
                   <li class="list-group-item">Dapibus ac facilisis in</li>
                </ul>
                <div class="card-body">
                   <a href="#" class="card-link">Card link</a>
                   <a href="#" class="card-link">Another link</a>
                </div>
             </div>
          </div>
       </div>
       <br/>
       <br/>
       <div class="row">
          <div class=" col-md-4"> Click here to select this<strong> column.</strong> Always place your content within a column. Columns are indicated by a dashed blue line. </div>
          <div class="col-md-4 "> You can <strong>resize a column</strong> using the handle on the right. Drag it to increase or reduce the number of columns.</div>
          <div class="col-md-4 "> You can <strong>offset a column</strong> using the handle on the left. Drag it to increase or reduce the offset. </div>
       </div>
       <br/>
       <br/>
       <div class="row">
          <div class="col-md-6 text-center">
             <div class="card">
                <div class="card-body">
                   <h3>Adding <strong>Buttons</strong></h3>
                   <p>Quickly add buttons to your page by using the button component in the insert panel. </p>
                   <button type="button" class="btn btn-info btn-md">Info Button</button>
                   <button type="button" class="btn btn-success btn-md">Success Button</button>
                </div>
             </div>
          </div>
          <div class="text-center col-md-6">
             <div class="card">
                <div class="card-body">
                   <h3>Adding <strong>Badges</strong></h3>
                   <p>Using the insert panel, add badge to your page by using the badge component.</p>
                   <span class="badge badge-info">Info Badge</span> <span class="badge badge-danger">Danger Badge</span>
                </div>
             </div>
          </div>
       </div>
       <br>
       <hr>
       <div class="row">
          <div class="text-center col-lg-6 offset-lg-3">
             <h4>Footer </h4>
             <p>Copyright &copy; 2015 &middot; All Rights Reserved &middot; <a href="#" >My Website</a></p>
          </div>
       </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed --> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
