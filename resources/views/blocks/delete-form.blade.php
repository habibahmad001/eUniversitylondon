<form method="POST" action="" id="delete-form">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="_method" value="DELETE">
  <input type="hidden" id="current_model" value="{{ $model }}">
</form>
