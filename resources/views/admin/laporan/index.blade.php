<h2>Laporan Keuangan (Admin)</h2>

<form method="POST" action="{{ route('laporan.harian') }}">
    @csrf
    <button type="submit">Laporan Harian</button>
</form>

<form method="POST" action="{{ route('laporan.mingguan') }}">
    @csrf
    <button type="submit">Laporan Mingguan</button>
</form>

<form method="POST" action="{{ route('laporan.bulanan') }}">
    @csrf
    <button type="submit">Laporan Bulanan</button>
</form>
