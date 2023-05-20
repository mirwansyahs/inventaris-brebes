<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title; ?></h1>
		</div>

		<div class="section-body">
			<!-- main -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i></button>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="table-1">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Distribusi</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($distribusi as $i => $dis) : ?>
											<tr>
												<td><?= $i + 1; ?></td>
												<td><?= $dis->distribusi; ?></td>
												<td>
													<div class="dropdown">
														<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Action
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<a href="<?= base_url('admin/distribusi/delete/' . $dis->id); ?>" class="dropdown-item"><i class="fas fa-trash"></i> Delete</a>
															<a href="javascript:void(0)" class="dropdown-item edit_btn" data-toggle="modal" data-target="#modalEdit" data-id="<?= $dis->id; ?>" data-distribusi="<?= $dis->distribusi; ?>"><i class="fas fa-arrow-left"></i> Edit</a>
														</div>
													</div>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end main -->
		</div>
	</section>
</div>

<!-- modal add -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAdd">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Distribusi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('admin/distribusi/add'); ?>" method="post">
					<div class="form-group">
						<label>Distribusi</label>
						<input type="text" class="form-control" name="distribusi">
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- modal edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEdit">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Distribusi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('admin/distribusi/edit'); ?>" method="post">
					<input type="hidden" name="id" id="idDistribusi">
					<div class="form-group">
						<label>Distribusi</label>
						<input type="text" class="form-control" name="distribusi" id="distribusi">
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	let edit_btn = $('.edit_btn');

	$(edit_btn).each(function(i) {
		$(edit_btn[i]).click(function() {
			let id = $(this).data('id');
			let distribusi = $(this).data('distribusi');

			$('#idDistribusi').val(id);
			$('#distribusi').val(distribusi);
		});
	});
</script>