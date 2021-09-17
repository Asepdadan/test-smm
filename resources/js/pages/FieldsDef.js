import moment from "moment"
import accounting from "accounting"

export default [
    {
        name: "name",
        title: '<i class="grey user outline icon"></i>Name',
        width: "20%"
    },
    {
        name: "email",
        title: '<i class="grey mail outline icon"></i>Email',
        width: "20%"
    },
    {
        name: "group.description",
        title: '<i class="grey sitemap icon"></i>Group',
        width: "15%"
    },
    {
        name: "birthdate",
        title: '<i class="grey birthday icon"></i>Birthdate',
        width: "15%",
        formatter: (value) => {
            return (value === null)
                ? ''
                : moment(value, 'YYYY-MM-DD').format('MMM Do, YYYY')
        }
    },
    {
        name: "gender",
        title: '<i class="grey heterosexual icon"></i>Gender',
        titleClass: "center aligned",
        dataClass: "center aligned",
        width: "15%",
        formatter: (value) => {
            return value.toUpperCase() === 'M'
                ? '<span class="ui teal label"><i class="large man icon"></i>Male</span>'
                : '<span class="ui pink label"><i class="large woman icon"></i>Female</span>'
        }
    },
    {
        name: "salary",
        title: '<i class="grey money icon"></i>Salary',
        titleClass: "center aligned",
        dataClass: "right aligned",
        width: "15%",
        formatter: (value) => accounting.formatNumber(value, 2)
    }
]
