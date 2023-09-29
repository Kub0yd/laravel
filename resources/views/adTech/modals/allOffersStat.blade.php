<div class="modal fade " id="offer-{{$offer->id}}-statistic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Statistic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>

            <div class="modal-body">
                <table class="table table-dark table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Период</th>
                        <th scope="col">Доходы</th>
                        <th scope="col">Переходы</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">День</th>
                        <td class="income-stat income-day">{{Auth::user()->transactions->where('offer_id', $offer->id)->where('created_at', '>=', now()->format('Y-m-d'))
                            ->where('created_at', '<', now()->addDay()->format('Y-m-d'))
                            ->sum('cost')*0.8}}</td>
                        <td class="transitions-stat transitions-day">{{Auth::user()->transactions->where('offer_id', $offer->id)->where('created_at', '>=', now()->format('Y-m-d'))
                            ->where('created_at', '<', now()->addDay()->format('Y-m-d'))
                            ->count()}}</td>

                    </tr>
                    <tr>
                        <th scope="row">Месяц</th>
                        <td class="income-stat income-month">{{Auth::user()->transactions->where('offer_id', $offer->id)->where('created_at', '>=', now()->firstOfMonth()->format('Y-m-d'))
                            ->where('created_at', '<', now()->addMonth()->firstOfMonth()->format('Y-m-d'))
                            ->sum('cost')*0.8}}
                        </td>
                        <td class="transitions-stat transitions-month">{{Auth::user()->transactions->where('offer_id', $offer->id)->where('created_at', '>=', now()->firstOfMonth()->format('Y-m-d'))
                            ->where('created_at', '<', now()->addMonth()->firstOfMonth()->format('Y-m-d'))
                            ->count()}}
                        </td>

                    </tr>
                    <tr>
                        <th scope="row">Год</th>
                        <td class="income-stat income-year">{{Auth::user()->transactions->where('offer_id', $offer->id)->where('created_at', '>=', now()->firstOfYear()->format('Y-m-d'))
                            ->where('created_at', '<', now()->addYear()->firstOfYear()->format('Y-m-d'))
                            ->sum('cost')*0.8}}
                        </td>
                        <td class="transitions-stat transitions-year">{{Auth::user()->transactions->where('offer_id', $offer->id)->where('created_at', '>=', now()->firstOfYear()->format('Y-m-d'))
                            ->where('created_at', '<', now()->addYear()->firstOfYear()->format('Y-m-d'))
                            ->count()}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
