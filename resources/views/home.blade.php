<!doctype html>
<html lang="en">
  <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>WiZag Project</title>
  </head>
  <body>
   


    <div class="container container-fluid">
      <div class="row p-0 justify-content-center">
        <div class="col-12 col-md-6 p-2">
          <div class="card">
            <div class="card-header">
              <h4 class="h4">LOGIN TO START YOUR SESSION</h4>
            </div>
            <div class="card-body">
              <form method="POST" action=" {{ route('login') }} ">
                @csrf
                @method('POST')

                <div class="row p-2">
                  <div class="col-12 col-md-6">
                    <label for="email">Email: </label>
                  </div>
                  <div class="col-12 col-md-6">
                    <input id="email" type="email" name="email" class="form-control">
                  </div>
                </div>
                <div class="row p-2">
                  <div class="col-12 col-md-6">
                    <label for="password">Password: </label>
                  </div>
                  <div class="col-12 col-md-6">
                    <input id="password" type="password" name="password" class="form-control">
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 text-center">
                    <input type="submit" name="submit" value="LOGIN" class="btn btn-solid btn-primary">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
