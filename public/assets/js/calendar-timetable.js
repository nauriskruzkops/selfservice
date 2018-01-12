Timetable = function (storage) {
    this.storage = [];
    if (typeof(storage) !== 'undefined') {
        this.add()
    }
};

Timetable.prototype.add = function (data)
{
    this.storage.push(data);
    return this;
};

var timetable = new Timetable();