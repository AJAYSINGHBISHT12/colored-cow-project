<template>
	<div>
		<table class="table table-bordered table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Role</th>
					<th>Permissions</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(role, index) in allRoles" :key="index">
					<td>
						<div class="mb-1">{{ role.label }}</div>
						<div class="text-muted fz-14">{{ role.description }}</div>
					</td>
					<td>
						<span>Assigned: {{ role.permissions.length }}</span>
					</td>
					<td class="w-300">
						<button
							class="btn btn-sm btn-outline-info"
							@click="updatePermissionModal(index)"
							data-toggle="modal"
							data-target="#update_role_permissions_modal"
						>
							Manage permissions
						</button>
						<button
							type="button"
							data-toggle="modal"
							v-on:click="removeRole(index)"
							class="btn btn-sm btn-outline-danger"
						>
							<i aria-hidden="true" class="fa fa-trash fa-lg"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
		<role-permission-update-modal
			:updateRoute="this.updateRoute"
			:role="this.selectedRole"
			:permissions="this.permissions"
			@rolePermissionsUpdated="onRolePressionsUpdated"
		/>
	</div>
</template>

<script>
export default {
	props: ["roles", "updateRoute", "permissions"],

	data() {
		return {
			currentUserIndex: 0,
			roleInputs: [],
			allRoles: this.roles,
			selectedRole: {},
		};
	},

	methods: {
		formatRoles(user) {
			let roleNames = [];
			let userRoles = user.roles;
			for (var i in userRoles) {
				let roleName = userRoles[i].label;
				roleNames.push(roleName);
			}

			return roleNames.join(", ");
		},

		updatePermissionModal: function(index) {
			this.currentUserIndex = index;
			this.selectedRole = this.roles[index];
		},
		onRolePressionsUpdated: function(selectedPermissions) {
			Vue.set(this.selectedRole, "permissions", selectedPermissions);
		},

		removeRole: async function(index) {
			let id = this.allRoles[index]["id"];
			let route = `/user/delete-roles/${id}`;
			let response = await axios.delete(route);
			this.allRoles.splice(index, 1);
			this.$toast.success("Role removed successfully!");
		},
	},
};
</script>
