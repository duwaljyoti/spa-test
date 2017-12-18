<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style>
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,300);

    html, #app {
        height: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        border: 0;
        height: 100%;
        max-height: 100%;
        position: relative;
    }

    #toolbar {
        float: left;
        width: 80px;
        height: 100%;
        background-color: #30414D;
        color: #767676;
        padding: 35px 25px 25px 25px;
    }

    #notes-list {
        float: left;
        width: 300px;
        height: 100%;
        background-color: #F5F5F5;
        font-family: 'Raleway', sans-serif;
        font-weight: 400;
    }

    #list-header {
        padding: 5px 25px 25px 25px;
    }

    #list-header h2 {
        font-weight: 300;
        text-transform: uppercase;
        text-align: center;
        font-size: 22px;
        padding-bottom: 8px;
    }

    #notes-list .container {
        height: calc(100% - 137px);
        max-height: calc(100% - 137px);
        overflow: auto;
        width: 100%;
        padding: 0;
    }

    #notes-list .container .list-group-item {
        border: 0;
        border-radius: 0;
    }

    .list-group-item-heading {
        font-weight: 300;
        font-size: 15px;
    }

    #note-editor {
        height: 100%;
        margin-left: 380px;
    }

    #note-editor textarea {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    #toolbar i {
        font-size: 30px;
        margin-bottom: 35px;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.5s ease;
    }

    #toolbar i:hover {
        opacity: 1;
    }

    .starred {
        color: #F7AE4F;
    }

</style>
</head>
<body>
<div id="app">
    <div id="toolbar">
        <i @click="addNote" class="glyphicon glyphicon-plus"></i>
        <i @click="toggleFavorite"
           class="glyphicon glyphicon-star"
           :class="{starred: activeNote.favorite}"></i>
        <i @click="deleteNote" class="glyphicon glyphicon-remove"></i>
    </div>
<div id="notes-list">

    <div id="list-header">
        <h2>Notes | coligo</h2>
        <div class="btn-group btn-group-justified" role="group">
            <!-- All Notes button -->
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default"
                        class="active"
                >
                    All Notes
                </button>
            </div>
            <!-- Favorites Button -->
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default"
                        @click="show = 'favorites'"
                        class="active"
                >
                    Favorites
                </button>
            </div>
        </div>
    </div>
    <!-- render notes in a list -->
    <div class="container">
        <div class="list-group">
            <a v-for="note in filteredNotes"
               class="list-group-item" href="#"
               class="active"
               @click="updateActiveNote(note)">
                <h4 class="list-group-item-heading">
                    ioio
                </h4>
            </a>
        </div>
    </div>

</div>
</div>

</body>
</html>