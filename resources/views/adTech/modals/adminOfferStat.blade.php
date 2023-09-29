<div class="modal fade" id="offer-control" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Statistic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class="col">
                        <h3>Подписчики</h3>
                        <table  class="table table-sm  table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Webmaster URL</th>
                                    <th scope="col">All time income value</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Transaction errors</th>
                                </tr>
                            </thead>
                            <tbody class='offer-user-info'>
                                <tr >
                                    <th scope="row">
                                        <svg class='offer-indicator active-indicator' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 20" >
                                            <circle cx="8" cy="8" r="8"/>
                                        </svg>
                                    </th>
                                    <td>
                                        <span class='offer-id'>#12</span>
                                    </td>
                                    <td>
                                        <span class="creator" >Test</span>
                                    </td>
                                    <td>
                                        <a href="http://localhost/admin" class="">http://localhost/admin</a>
                                    </td>
                                    <td>
                                        <span>1 &#8381</span>
                                    </td>
                                    <td>
                                        <span>Webmaster, Admin, Creator</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary modal-act errors" data-bs-toggle="modal" data-bs-target="#attempts-error">
                                            ошибки переходов
                                         </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
