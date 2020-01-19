<?php
//add new category name
if($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['addcat'])){
	if(empty($_POST['cat'])){
		$addcatmsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$cat = $fm->validation($_POST['cat']);
		$cat = mysqli_escape_string($db->conn, $cat);
		$query = "SELECT cat FROM lm_cat WHERE cat='$cat'";
		$query = $db->select($query);
		if ($query != false) {
			$addcatmsg = "<p class='alert alert-warning'>Category name already exist!</p>";
		} else {
			$query = "INSERT INTO lm_cat(cat) VALUES('$cat')";
			$query = $db->insert($query);
			if ($query != false) {
				$addcatmsg = "<p class='alert alert-success'>Category name added successfully!</p>";
			} else{
				$addcatmsg = "<p class='alert alert-warning'>Category name not added!</p>";
			}
		}
	}
}

//edit category name
elseif($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editCat'])){
	if(empty($_POST['cat'])){
		$editCatMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$cat = $fm->validation($_POST['cat']);
		$cat = mysqli_escape_string($db->conn, $cat);

		$query = "SELECT cat FROM lm_cat WHERE cat='$cat'";
		$query = $db->select($query);
		if ($query != false) {
			$editCatMsg = "<p class='alert alert-warning'>Category name already exist!</p>";
		} else {
			$query = "SELECT cat FROM lm_cat WHERE id='$id'";
			$query = $db->select($query);
			while ($result = $query->fetch_assoc()) {
				$catname = $result['cat'];
			}

			$quborrow = "SELECT catname FROM lm_borrow WHERE catname='$catname'";
			$quborrow = $db->select($quborrow);
			if ($quborrow != false) {
				$editCatMsg = "<p class='alert alert-warning'>Opps! Can't update this category. Because this category has in borrow list or return list.</p>";
			} else {
				$queryCat = "UPDATE lm_cat SET cat='$cat' WHERE id='$id'";
				$queryCat = $db->update($queryCat);

				$queryBook = "UPDATE lm_book SET catname='$cat' WHERE catname='$catname'";
				$queryBook = $db->update($queryBook);
				if ($queryCat != false && $queryBook != false) {
					$editCatMsg = "<p class='alert alert-success'>Category name updated successfully!</p>";
				} else{
					$editCatMsg = "<p class='alert alert-warning'>Category name not updated!</p>";
				}
			}
		}
	}
}
?>