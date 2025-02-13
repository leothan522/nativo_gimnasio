<div class="card card-primary card-outline" id="div_card_table">
    <div class="card-header" id="div_card_table_header">
        <h3 class="card-title">
            Búsqueda
            <span class="text-nowrap">{ <b class="text-warning">text</b> }</span>
            <span class="text-nowrap">[ <b class="text-warning">999</b> ]</span>
            <button class="d-sm-none btn btn-tool text-warning">
                <i class="fas fa-times"></i>
            </button>
            <!--Todos [ <b class="text-warning">9999</b> ]-->
        </h3>
        <div class="card-tools">

            <button type="button" class="btn btn-tool">
                <i class="fa-solid fa-rotate"></i>
            </button>
            <button type="button" class="btn btn-tool" onclick="verMas()">
                <i class="fa-solid fa-arrow-down-short-wide"></i> Ver mas
            </button>

        </div>
    </div>
    <div class="card-body table-responsive p-0" id="div_card_table_body" style="max-height: calc(100vh - 320px)">


        <table class="table table-sm table-hover table-head-fixed">
            <thead class="table-light">
            <tr>
                <th class="text-uppercase text-primary-emphasis">Codigo</th>
                <th class="text-uppercase text-primary-emphasis">Nombre</th>
                <th class="text-center text-primary-emphasis" style="width: 10%"><small class="text-nowrap">Rows 999</small></th>
            </tr>
            </thead>
            <tbody id="tbody_card_table">
                <?php for ($i = 0; $i < 50; $i++){ ?>
                    <tr class="align-middle">
                        <td class="text-uppercase">20.025.623</td>
                        <td class="text-uppercase text-truncate" style="max-width: 150px">yonathan leonardo castillo romero</td>
                        <td class="">
                            <div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups">

                                <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>

                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>




    </div>
    <!-- /.card-body -->
    <div class="card-footer" id="div_card_table_footer">
        <span data-rows="9999" id="total_rows"> Mostrando <b class="text-warning">9999</b></span>
    </div>
    <!-- /.card-footer-->
</div>
