<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

        <title>Hello, world!</title>
    </head>
    <body>


        <form method="POST">
            <div class="form-group">
                <label for="bencode">Bencode</label>
                <input name="bencode" type="text" class="form-control" id="bencode" aria-describedby="bencodeHelp" placeholder="Enter bencode">
                <small id="bencodeHelp" class="form-text text-muted">Decoding bencode data</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        require_once 'Bencode.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(!empty($_POST['bencode']))
            {
                $bencode=$_POST['bencode'];
                print '<br>'.$bencode.'<br>';
                $obj=new Bencode($bencode);
                $obj->decode();
                print '<pre>'.print_r($obj->getDecoded(), 1).'</pre>';
            }
        }

        ?>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </body>
</html>