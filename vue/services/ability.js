import { AbilityBuilder } from "@casl/ability";

function subjectName(item) {
    if(!item || typeof item === 'string') {
        return item;
    }
    return item._type
}

export default AbilityBuilder.define( { subjectName }, can => {
    can(['read', 'create'], 'Todo')
    can(['update', 'delete'], 'Todo')
});