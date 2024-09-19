from flask import Flask, request, jsonify
from flask_restful import Api, Resource
from googleapiclient.discovery import build
from googleapiclient.errors import HttpError

app = Flask(__name__)
api = Api(app)

API_KEY = "AIzaSyCV8moVHl9EoZm71XZIax6dZbxeHU4F0PE"

youtube = build('youtube', 'v3', developerKey=API_KEY)

class MovieTrailer(Resource):
    def get(self, movie_title):
        try:
            search_response = youtube.search().list(
                q=f"{movie_title} official trailer",
                type="video",
                part="id,snippet",
                maxResults=1
            ).execute()

            if search_response['items']:
                video_id = search_response['items'][0]['id']['videoId']
                trailer_link = f"https://www.youtube.com/watch?v={video_id}"
                return {
                    "data": {
                        "type": "trailer",
                        "id": video_id,
                        "attributes": {
                            "title": movie_title,
                            "link": trailer_link
                        },
                        "links": {
                            "self": f"/movies/{movie_title}/trailer"
                        }
                    }
                }, 200
            else:
                return {"errors": [{"detail": "No trailer found"}]}, 404

        except HttpError as e:
            return {"errors": [{"detail": f"An error occurred: {str(e)}"}]}, 500

api.add_resource(MovieTrailer, '/movies/<string:movie_title>/trailer')

if __name__ == '__main__':
    app.run(debug=True, port=5000)