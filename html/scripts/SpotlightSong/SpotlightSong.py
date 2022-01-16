import os
import pathlib
import spotipy
from spotipy.oauth2 import SpotifyClientCredentials
import random
import datetime

"""Method to create the Song ID list based on the Information Action Ratio Playlist"""
def createSongIdList():

    song_id_list = []

    client_id = "d249d6e4411845a697866b01cfb9a140"
    client_secret = "7db6403bb0764388b05ba75c70e61d05"

    playlist_urn="spotify:playlist:3QCouJ6JF1KvKAoEHh1RGb"

    client_credentials_manager = SpotifyClientCredentials(client_id = client_id, client_secret = client_secret, cache_handler=None)
    sp = spotipy.Spotify(client_credentials_manager=client_credentials_manager)


    playlist = sp.playlist(playlist_urn)
    playlist_total_tracks = playlist["tracks"]["total"]

    iterations = round(playlist_total_tracks / 100)

    for i in range(iterations):
        playlist_tracks = sp.playlist_tracks(playlist_urn, offset = i*100)['items']  
        
        for track in playlist_tracks:
            track_id = track["track"]["id"]
            song_id_list.append(track_id)
    
    return song_id_list



"""Method to read the last updated date"""
def readLastUpdatedDate():

    with open("last_updated.txt", "r") as file:
        last_date = file.readline()
        last_datetime = datetime.datetime.strptime(last_date, '%d/%m/%Y').date()

    return last_datetime

#Method to update the current date
def updateLastUpdatedDate(new_date):
    with open("last_updated.txt", "w") as file:
        new_date = new_date.strftime("%d/%m/%Y")
        file.write(new_date)


#Method to update the song that will be displayed
def updateCurrentSong(song_id_list):

    song_id_list_size = len(song_id_list)
    random_song_index = random.randint(0, song_id_list_size-1)
    random_song_id = song_id_list[random_song_index]

    with open("current_song.txt", "w") as file:
        file.write(random_song_id)
    
    return random_song_id


def readCurrentSong():
    with open("current_song.txt", "r") as file:
        current_song_id = file.readline()
    return current_song_id


#Main method
def main():

    #Setting the current path
    os.chdir(pathlib.Path(__file__).parent.resolve())

    last_datetime = readLastUpdatedDate()
    current_datetime = datetime.date.today()

    if(current_datetime > last_datetime):
        
       song_id_list = createSongIdList()
       updateLastUpdatedDate(current_datetime)
       updateCurrentSong(song_id_list)

    current_song = readCurrentSong()
    print(current_song)
    return current_song


if __name__ == "__main__":
    main()









