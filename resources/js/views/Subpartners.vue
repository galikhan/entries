<template>
    <Table
        :entity="entity"
        :loading="loading"
        @new-entity="newEntity"
        @on-next="onNext"
        @on-prev="onPrev"
        @on-edit="onEdit"
        @on-delete="onDelete"
        @on-search="onSearch"
    />
</template>

<script>
import common from "@/mixins/common";
import pagination from "@/mixins/pagination";
import Table from "../components/Table.vue";
export default {
    name: "Subpartners",
    components: {
        Table,
    },
    mixins: [common, pagination],
    data() {
        return {
            entity: {
                label: this.$t("Subpartners"),
                route: "subpartners",
                pad: import.meta.env.VITE_PAD_SUBPARTNER_ID,
                fillables: [
                    {
                        label: this.$t("Name"),
                        name: "name",
                        classes: "col-4 col-sm-6 col-lg-8",
                        dataClasses: "py-1 text-truncate",
                    },
                    {
                        label: this.$t("Partner"),
                        raw: (data) => data.partner.name,
                        data: "raw",
                    },
                    {
                        label: this.$t("Created at"),
                        raw: (data) =>
                            data.created_at
                                .replaceAll("T", " ")
                                .substring(0, 16),
                        data: "raw",
                    },
                    {
                        label: this.$t("BIN"),
                        name: "bin",
                        classes: "col-4 col-sm-6 col-lg-8",
                        dataClasses: "py-1 text-truncate",
                    },
                ],
                page: null,
            },
        };
    },
};
</script>
