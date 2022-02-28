<template>
  <div>
    <div class="tile">
      <h3 class="tile-title">Attribute Values</h3>
      <hr />
      <div class="tile-body">
        <div class="form-group">
          <label class="control-label" for="value">Value</label>
          <input
            class="form-control"
            type="text"
            placeholder="Enter attribute value"
            id="value"
            name="value"
            v-model="value"
          />
        </div>
        <div v-if="message">
            <p class="text-danger">{{ message }}</p>
        </div>
      </div>
      <div class="tile-footer">
        <div class="row d-print-none mt-2">
          <div class="col-12 text-right">
            <button
              class="btn btn-success"
              type="submit"
              @click.prevent="createValue()"
              v-if="addValue"
            >
              <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
            </button>
            <button
              class="btn btn-success"
              type="submit"
              @click.prevent="updateValue()"
              v-if="!addValue"
            >
              <i class="fa fa-fw fa-lg fa-check-circle"></i>Update
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="tile">
      <h3 class="tile-title">Option Values</h3>
      <div class="tile-body">
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>#</th>
                <th>Value</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in values" :key="value.id">
                <td>{{ value.id }}</td>
                <td>{{ value.value }}</td>
                <td>
                  <button class="btn btn-sm btn-primary" @click.prevent="editValue(value)">
                    <i class="fa fa-edit"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" @click.prevent="deleteValue(value)">
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    name: 'attribute-values',
    props: ['attributeid'],
    data() {
        return {
            values: [],
            value: '',
            message: '',
            currentId: '',
            addValue: true,
            key: 0
        }
    },
    created() {
        this.loadValues();
    },
    methods: {
        loadValues () {
            axios.get(`/admin/attributes/${this.attributeid}/get-values`)
                .then(response => {
                    this.values = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        createValue () {
            if (this.validationHandler()) return;

            axios.post(`/admin/attributes/${this.attributeid}/add-value`, {
                value: this.value
            })
            .then(response => {
                this.values.push(response.data);
                //this.loadValues();
                this.value = '';
                this.$swal('Success! Value created successfully!', {
                    icon: 'success'
                });
            })
            .catch(error => {
                console.log(error);
            })
        },
        editValue (value) {
            this.addValue = false;
            this.currentId = value.id;
            this.value = value.value;
            this.key = this.values.indexOf(value);
        },
        updateValue () {
            if (this.validationHandler()) return;

            axios.put(`/admin/attributes/${this.attributeid}/update-value`, {
                value: this.value,
                valueId: this.currentId
            })
            .then(response => {
                this.loadValues();
                this.value = '';
                this.addValue = true;
                this.$swal('Success! Value updated successfully!', {
                    icon: 'success'
                });
            })
            .catch(error => {
                console.log(error);
            })
        },
        deleteValue (value) {
            this.$swal({
                title: 'Are you sure?',
                text: 'Once deleted, you will not be able to recover this attribute value!',
                icon: 'warning',
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    this.currentId = value.id,
                    this.key = this.values.indexOf(value);
                    axios.post(`/admin/attributes/${this.attributeid}/delete-value`, {
                        valueId: this.currentId
                    })
                    .then(response => {
                        if (response.data.status === 'success') {
                            this.values.splice(this.key, 1);
                            this.$swal('Success! Option value has been deleted!', {
                                icon: 'success'
                            })
                        } else {
                            this.$swal('Your option value not deleted!');
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
                } else {
                    this.$swal('Your option value not deleted!');
                }
            })
        },
        validationHandler () {
            if (!this.value.length) {
                return this.$swal('Error! Value for attribute is required.', {
                    icon: 'error'
                });
            }

            if (this.value.length < 3) {
                return this.$swal('Error! Value for attribute must be at least 3 characters.', {
                    icon: 'error'
                });
            }
        }
    },
}
</script>
<style>
    tr {
        text-align: center;
    }

    td {
        width: 25%;
    }
</style>