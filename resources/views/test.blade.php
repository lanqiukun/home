<form method="post">
    {{ csrf_field() }}
    <input type="checkbox" name="remember">

    <button type="submit">submit</button>
</form>