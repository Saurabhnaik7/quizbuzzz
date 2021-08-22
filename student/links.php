<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/638e819b23.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="main.js"></script>
  <style type="text/css">
  body{
    overflow-x: hidden;
  }
  .vertical-nav{
    min-width: 17rem;
    width: 17rem;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    transition: all 0.4s;
    background-color: #1b3e5c;
  }
  .page-content{
    width: calc(100% - 17rem);
    margin-left: 17rem;
    transition: all 0.4s;
  }
  #sidebar.active{
    margin-left: -17rem;
  }
  #content.active{
    width: 100%;
    margin: 0;
  }
  .logo{
    background-color:#0e2e4a ;
  }
  .navbar-brand{
    color: #fff;
    margin-left: 22%;
    font-size: 25px;
  }
  .navbar-brand:hover{
    color: #fff;
  }
  .nav-link{
    color: #bdb8d7;
  }
  .nav-link:hover{
    color: #fff;
  }
  .vertical-nav ul li:hover{
    background: #0e2e4a;
  }
  .media-body h4,p{
    color: #fff;
  }
  @media(max-width768px){
    #sidebar{
      margin-left: -17rem;
    }
    #sidebar.active{
      margin-left: 0;
    }
    #content{
    width: 100%;
    margin: 0;
    }
    #content.active{
      margin-left: 17rem;
      width: calc(100% - 17rem);
    }
  }
  .btn{
      background: #1b3e5c;
      cursor: pointer;
      color: white;
    }
  
</style>

  