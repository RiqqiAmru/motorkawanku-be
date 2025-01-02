<div>
    <table>
        <thead>
            <tr>
                <th>Wilayah / RT</th>
                @for ($i = 2019; $i <= 2024; $i++)
                    <th colspan="2">{{ $i == 2019 ? 'Baseline' : $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
