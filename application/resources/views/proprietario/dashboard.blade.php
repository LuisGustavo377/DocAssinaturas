<h2>Proprietario Dashboard</h2>

<form method="POST" action="{{ route('proprietario.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>