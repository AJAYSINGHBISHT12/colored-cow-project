<template id="my-application">
	<div class="filter form-group-row-sm-10" style="display: flex;">
		<label style= "margin-top: 0.5rem;">Status: </label>
		<div class="row justify-content-center mt-100" style="width: 120%;">
			<div class="col-sm-10">
				<select class="job-application-filters" id="choices-multiple-remove-button" placeholder="Select one or more status"  multiple>
					<option v-for="option in options" :value="option" :key="option.id">{{ option.name }}</option>
				</select>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			selected: null,
			options: [
				{ id: "1", name: "New Application" },
				{ id: "2", name: "In Progress"},
				{ id: "3", name: "Awaiting Confirmation"},
				{ id: "4", name: "Need Follow Up"},
				{ id: "5", name: "Send For Approval"},
				{ id: "6", name: "No Show"},
				{ id: "7", name: "No Show Reminded"},
				{ id: "8", name: "OnBoard"},
				{ id: "9", name: "Closed"}
			]
		};
	}
};
</script>
