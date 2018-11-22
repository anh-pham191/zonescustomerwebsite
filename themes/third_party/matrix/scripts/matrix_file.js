(function($) {


Matrix.bind('file', 'display', function(cell){

	var $thumb = $('> div.matrix-thumb', cell.dom.$td),
		$removeBtn = $('> a', $thumb),
		$thumbImg = $('> img', $thumb),
		$filename = $('> div.matrix-filename', cell.dom.$td),

		$filedirInput = $('> input.filedir', cell.dom.$td),
		$filenameInput = $('> input.filename', cell.dom.$td),
		$addBtn = $('> a.matrix-add', cell.dom.$td);


	var id = cell.field.id+'_'+cell.row.id+'_'+cell.col.id+'_file';

	var removeFile = function(){
		$thumb.remove();
		$filename.remove();
		$filedirInput.val('');
		$filenameInput.val('');
		$addBtn.show();
		cell.dom.$td.find('.existing_file').remove();
	};

	$removeBtn.click(removeFile);

	cell.selectFile = function(directory, name, thumb) {

		// validation
		if (! (directory && name)) {
			setTimeout(function(){
				alert(Matrix.lang.select_file_error);
			}, 250);

			return;
		}

		// update the inputs
		$filedirInput.val(directory);
		$filenameInput.val(name);

		$addBtn.hide();

		// add the new dom elements
		$thumb = $('<div class="matrix-thumb" />').prependTo(cell.dom.$td);
		$removeBtn = $('<a title="'+Matrix.lang.remove_file+'" />').appendTo($thumb);
		$thumbImg = $('<img />').appendTo($thumb);
		$filename = $('<div class="matrix-filename">'+name+'</div>').appendTo(cell.dom.$td);

		$removeBtn.click(removeFile);

		// prepare to set the container's width
		$thumbImg.load(function() {
			// wait a second...
			setTimeout(function() {
				$thumb.width($thumbImg.width());
			}, 0);
		});

		// load the new thummb
		$thumbImg.attr('src', thumb);
	};

	// add_trigger() in EE 2.2 gained the 'settings' argument
	if (cell.settings.ee22plus) {
		if(eever == 2) {
			$.ee_filebrowser.add_trigger($addBtn, id, {
				content_type: (cell.settings.content_type ? cell.settings.content_type : 'any'),
				directory:    (cell.settings.directory ? cell.settings.directory : 'all')
			}, function(file, field){
				cell.selectFile(file.upload_location_id, file.file_name, file.thumb);
			});
		} else {
			$('.matrix .filepicker').FilePicker({
			  callback: function(data, references) {
				// Close the modal
				references.modal.find('.m-close').click();

				// do work with data
				// console.log(data, references);

				// Find the original source cell for the filepicker
				var sourceCell = cell; // Fallback in case we don't find the actual one
				var sourceId = references.source.get(0).id;
				var IdRegex = /(field_id_[\d]+)\[(row_[newid_\d]+)\]\[(col[newid_\d]+)\]/g;
				var matches = IdRegex.exec(sourceId);
				var fieldId = matches[1],
					rowId = matches[2],
					colId = matches[3];

				loop1:
				for (var i = 0; i < Matrix.instances.length; i++) {
					var matrixField = Matrix.instances[i];
					if (fieldId != matrixField.id) {
						continue loop1; // get the next field
					}

					// Otherwise, we know this is the correct matrix field
					// and can start looping over the rows
					loop2:
					for (var i = 0; i < matrixField.rows.length; i++) {
						var matrixRow = matrixField.rows[i];
						if (rowId != matrixRow.id) {
							continue loop2; // get the next row
						}

						// Otherwise, we know this is the correct row
						// and can start looping over the cells
						loop3:
						for (var i = 0; i < matrixRow.cells.length; i++) {
							var matrixCell = matrixRow.cells[i];

							if (colId == matrixCell.col.id) {
								sourceCell = matrixCell;
								break loop1; // stop looping once we find the cell
							}
						}
					}
				}

				sourceCell.selectFile(data.upload_location_id, data.file_name, data.thumb_path);
			  }
			});
		}
	} else {
		$.ee_filebrowser.add_trigger($addBtn, id, function(file, field){
			cell.selectFile(file.directory, file.name, file.thumb);

			// restore everything to default state
			$.ee_filebrowser.reset();
		});
	}
});

})(jQuery);