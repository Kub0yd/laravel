<div class="modal fade" id="user-control" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="exampleModalLongTitle">Statistic</h5> --}}
                <div class="row">
                    <div class="col-auto">
                        Username:
                        <span class="stat-user-name">qawawsdwdw</span>
                    </div>
                    <div class="col-auto">
                        User ID:
                        <span class="stat-user-id">123</span>
                    </div>

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>

            <div class="modal-body">
                <div class="row user-stat">
                    <div class="col">
                        <h5>User subs</h5>
                        <table class="table table-sm table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Creator</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">User URL</th>
                                    <th scope="col">User Income</th>
                                    <th scope="col">Transactions count</th>
                                </tr>
                            </thead>
                            <tbody class="user-subs">
                                <tr class="user-sub-offer-id-">
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
                                        <span class="sub-title" >Title</span>
                                    </td>
                                    <td>
                                        <a href="http://localhost/admin" class="">http://localhost/admin</a>
                                    </td>
                                    <td>
                                        <span class="income-val">1 &#8381</span>
                                    </td>
                                    <td>
                                        <span class="transations">1231</span>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <h5>User Role</h5>
                        <div class='row roles-checkbox'>
                            <div class='col'>
                                <div class="form-check">
                                    <input class="form-check-input role-webmaster role-input" type="checkbox" value="webmaster" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                     webmaster
                                    </label>
                                </div>
                            </div>
                            <div class='col'>
                                <div class="form-check">
                                    <input class="form-check-input role-admin role-input" type="checkbox" value="admin" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                      admin
                                    </label>
                                </div>
                            </div>
                            <div class='col'>
                                <div class="form-check">
                                    <input class="form-check-input role-creator role-input" type="checkbox" value="creator" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                      creator
                                    </label>
                                </div>
                            </div>
                            <div class='col'>
                                <button type="button" class="btn btn-sm btn-secondary" id="post-user-role">Save</button>
                            </div>
                        </div>
                        <h5>User statistic</h5>
                        <table class="table table-sm table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>Total income</th>
                                    <th>Total transactions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="total-income">123</td>
                                    <td id="total-transactions">213123</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>User offers</h5>
                        <table class="table table-sm table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">URL</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Subs</th>
                                    <th scope="col">Loss</th>
                                </tr>
                            </thead>
                            <tbody class="user-offers">
                                <tr >
                                    <th scope="row">
                                        <svg class='offer-indicator active-indicator' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 20" >
                                            <circle cx="8" cy="8" r="8"/>
                                        </svg>
                                    </th>
                                    <td>
                                        <span class='offer-id'></span>
                                    </td>
                                    <td>
                                        <span class="creator" ></span>
                                    </td>
                                    <td>
                                        <a href="" class=""></a>
                                    </td>
                                    <td>
                                        <span></span>
                                    </td>
                                    <td>
                                        <span></span>
                                    </td>
                                    <td>
                                        <span class="loss-val"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id='user-infopanel-close' data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
