if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition((position) => {
        localCoord = position.coords;
        objLocalCoord = {
            lat: localCoord.latitude,
            lng: localCoord.longitude,
        };

        let platform = new H.service.Platform({
            apikey: window.hereApiKey,
        });

        // Obtain the default map types from the platform object
        let defaultLayers = platform.createDefaultLayers();

        // Instantiate (and display) a map object:
        let map = new H.Map(
            document.getElementById("mapContainer"),
            defaultLayers.vector.normal.map,
            {
                zoom: 13,
                center: objLocalCoord,
                pixelRatio: window.devicePixelRatio || 1,
            }
        );
        window.addEventListener("resize", () => map.getViewPort().resize());

        let group = new H.map.Group();

        map.addObject(group);

        // add 'tap' event listener, that opens info bubble, to the group
        group.addEventListener(
            "tap",
            function (evt) {
                // event target is the marker itself, group is a parent event target
                // for all objects that it contains
                let bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
                    // read custom data
                    content: evt.target.getData(),
                });
                // show info bubble
                ui.addBubble(bubble);
            },
            false
        );

        let ui = H.ui.UI.createDefault(map, defaultLayers);
        let mapEvents = new H.mapevents.MapEvents(map);
        let behavior = new H.mapevents.Behavior(mapEvents);

        function addMarkerToGroup(group, coordinate, html) {
            var marker = new H.map.Marker(coordinate);
            // add custom data to the marker
            marker.setData(html);
            group.addObject(marker);
        }

        // Draggable Marker Function
        function addDragableMarker(map, behavior) {
            let inputLat = document.getElementById("lat");
            let inputLng = document.getElementById("lng");

            if (inputLat.value != "" && inputLng.value != "") {
                objLocalCoord = {
                    lat: inputLat.value,
                    lng: inputLng.value,
                };
            }

            let marker = new H.map.Marker(objLocalCoord, {
                volatility: true,
            });

            marker.draggable = true;
            map.addObject(marker);

            // disable the default draggability of the underlying map
            // and calculate the offset between mouse and target's position
            // when starting to drag a marker object:
            map.addEventListener(
                "dragstart",
                function (ev) {
                    let target = ev.target,
                        pointer = ev.currentPointer;
                    if (target instanceof H.map.Marker) {
                        let targetPosition = map.geoToScreen(
                            target.getGeometry()
                        );
                        target["offset"] = new H.math.Point(
                            pointer.viewportX - targetPosition.x,
                            pointer.viewportY - targetPosition.y
                        );
                        behavior.disable();
                    }
                },
                false
            );

            // Listen to the drag event and move the position of the marker
            // as necessary
            map.addEventListener(
                "drag",
                function (ev) {
                    let target = ev.target,
                        pointer = ev.currentPointer;
                    if (target instanceof H.map.Marker) {
                        target.setGeometry(
                            map.screenToGeo(
                                pointer.viewportX - target["offset"].x,
                                pointer.viewportY - target["offset"].y
                            )
                        );
                    }
                },
                false
            );

            // re-enable the default draggability of the underlying map
            // when dragging has completed
            map.addEventListener(
                "dragend",
                function (ev) {
                    let target = ev.target;
                    if (target instanceof H.map.Marker) {
                        behavior.enable();
                        let resultCoord = map.screenToGeo(
                            ev.currentPointer.viewportX,
                            ev.currentPointer.viewportY
                        );
                        // console.log(resultCoord)
                        inputLat.value = resultCoord.lat.toFixed(5);
                        inputLng.value = resultCoord.lng.toFixed(5);
                    }
                },
                false
            );
        }

        if (window.action == "submit") {
            addDragableMarker(map, behavior);
        }

        // Browse location codespace
        let umkm = [];
        let urlFetchUMKM = "";
        const fetchSpaces = function (
            latitude,
            longitude,
            radius,
            kecamatan = false
        ) {
            if (!kecamatan) {
                urlFetchUMKM = `${window.baseurl}/api/umkm?lat=${latitude}&lng=${longitude}&rad=${radius}`;
            } else {
                urlFetchUMKM = `${window.baseurl}/api/umkm?lat=${latitude}&lng=${longitude}&rad=${radius}&kecamatan=${kecamatan}`;
            }
            return new Promise(function (resolve, reject) {
                resolve(
                    fetch(urlFetchUMKM)
                        .then((res) => res.json())
                        .then(function (data) {
                            data.forEach(function (value, index) {
                                let marker = new H.map.Marker({
                                    lat: value.latitude,
                                    lng: value.longitude,
                                });
                                if (window.action == "browse") {
                                    marker.addEventListener(
                                        "tap",
                                        function (event) {
                                            console.log("TAP!");
                                            let router =
                                                    platform.getRoutingService(),
                                                routeRequestParam = {
                                                    mode: "fastest;car",
                                                    representation: "display",
                                                    routeattributes: "summary",
                                                    maneuverattributes:
                                                        "direction,action",
                                                    waypoint0: `${objLocalCoord.lat},${objLocalCoord.lng}`,
                                                    waypoint1: `${value.latitude},${value.longitude}`,
                                                };
                                            router.calculateRoute(
                                                routeRequestParam,
                                                onSuccess,
                                                onError
                                            );
                                        }
                                    );
                                    var infoBubble = new H.ui.InfoBubble(
                                        {
                                            lat: value.latitude,
                                            lng: value.longitude,
                                        },
                                        {
                                            content:
                                                `<div><a href="">` +
                                                value.name +
                                                ` </a></div>` +
                                                `<div style="font-size:12px">` +
                                                value.description +
                                                `<br />Jarak: ` +
                                                Math.round(
                                                    (value.distance +
                                                        Number.EPSILON) *
                                                        100
                                                ) /
                                                    100 +
                                                ` KM</div>` +
                                                `<img src="${window.baseurl}/photo/${value.photos[0]?.photo}" />` +
                                                `<div class="block mt-5 gap-2">
                                                    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-non focus:ring disabled:opacity-25 transition ease-in-out duration-150 text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 detail-map"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="${value.id}">Detail</button>
                                                    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-non focus:ring disabled:opacity-25 transition ease-in-out duration-150 text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 direction-map" data-id="${value.id}">Direction</button>
                                                </div>`,
                                        }
                                    );
                                    marker.addEventListener(
                                        "pointermove",
                                        function (evt) {
                                            if (
                                                evt.target instanceof
                                                    H.map.Marker ||
                                                evt.target instanceof
                                                    H.map.DomMarker
                                            ) {
                                                ui.addBubble(infoBubble);
                                                infoBubble.open();
                                            } else {
                                                infoBubble.close();
                                            }
                                            let buttonDetailMap =
                                                document.querySelectorAll(
                                                    ".detail-map"
                                                );
                                            let buttonDirectionMap =
                                                document.querySelectorAll(
                                                    ".direction-map"
                                                );

                                            for (
                                                let index = 0;
                                                index < buttonDetailMap.length;
                                                index++
                                            ) {
                                                buttonDetailMap[
                                                    index
                                                ].addEventListener(
                                                    "click",
                                                    function (e) {
                                                        document.getElementById(
                                                            "name"
                                                        ).value = value.name;
                                                        document.getElementById(
                                                            "address"
                                                        ).value = value.address;
                                                        document.getElementById(
                                                            "description"
                                                        ).value =
                                                            value.description;
                                                        document.getElementById(
                                                            "kecamatan_name"
                                                        ).value =
                                                            value.kecamatan_name;
                                                        document.getElementById(
                                                            "jenis_umkm"
                                                        ).value =
                                                            value.jenis_umkm_name;
                                                        document.getElementById(
                                                            "pemilik"
                                                        ).value =
                                                            value.user_name;
                                                        let photoHTML = "";
                                                        if (
                                                            value.photos
                                                                .length !== 0
                                                        ) {
                                                            value.photos?.forEach(
                                                                (photo) => {
                                                                    photoHTML += `<img class="h-auto"
                                                                src="${window.baseurl}/photo/${photo.photo}">`;
                                                                }
                                                            );
                                                            document.getElementById(
                                                                "photo"
                                                            ).innerHTML = photoHTML;
                                                        } else {
                                                            document.getElementById(
                                                                "photo"
                                                            ).innerHTML = `<img class="h-auto"
                                                            src="https://media.geeksforgeeks.org/wp-content/uploads/20190807114330/GFG115.png">`;
                                                        }
                                                        document.getElementById(
                                                            "lat"
                                                        ).value =
                                                            value.latitude;
                                                        document.getElementById(
                                                            "lng"
                                                        ).value =
                                                            value.longitude;
                                                    }
                                                );
                                            }

                                            for (
                                                let index = 0;
                                                index <
                                                buttonDirectionMap.length;
                                                index++
                                            ) {
                                                const element =
                                                    buttonDirectionMap[index];
                                                element.addEventListener(
                                                    "click",
                                                    function (e) {
                                                        infoBubble.close();
                                                        let router =
                                                                platform.getRoutingService(),
                                                            routeRequestParam =
                                                                {
                                                                    mode: "fastest;car",
                                                                    representation:
                                                                        "display",
                                                                    routeattributes:
                                                                        "summary",
                                                                    maneuverattributes:
                                                                        "direction,action",
                                                                    waypoint0: `${objLocalCoord.lat},${objLocalCoord.lng}`,
                                                                    waypoint1: `${value.latitude},${value.longitude}`,
                                                                };
                                                        router.calculateRoute(
                                                            routeRequestParam,
                                                            onSuccess,
                                                            onError
                                                        );
                                                    }
                                                );
                                            }
                                        }
                                    );
                                }
                                umkm.push(marker);
                            });
                        })
                );
            });
        };

        function clearSpace() {
            map.removeObjects(umkm);
            umkm = [];
        }

        function init(latitude, longitude, radius, kecamatan = false) {
            clearSpace();
            fetchSpaces(latitude, longitude, radius, kecamatan).then(
                function () {
                    map.addObjects(umkm);
                }
            );
        }

        if (window.action == "browse") {
            let kecamatan = document.getElementById("kecamatan");
            kecamatan.addEventListener("change", (e) => {
                e.preventDefault();
                var values = e.target.value;
                init(objLocalCoord.lat, objLocalCoord.lng, 40, values);
            });
            map.addEventListener(
                "dragend",
                function (ev) {
                    let resultCoord = map.screenToGeo(
                        ev.currentPointer.viewportX,
                        ev.currentPointer.viewportY
                    );
                    init(resultCoord.lat, resultCoord.lng, 40);
                },
                false
            );
            init(objLocalCoord.lat, objLocalCoord.lng, 40);
        }

        // Route to space
        let urlParams = new URLSearchParams(window.location.search);

        function calculateRouteAtoB(platform) {
            let router = platform.getRoutingService(),
                routeRequestParam = {
                    mode: "fastest;car",
                    representation: "display",
                    routeattributes: "summary",
                    maneuverattributes: "direction,action",
                    waypoint0: urlParams.get("from"),
                    waypoint1: urlParams.get("to"),
                };

            router.calculateRoute(routeRequestParam, onSuccess, onError);
        }

        function onSuccess(result) {
            route = result.response.route[0];
            addRouteShapeToMap(route);
            addSummaryToPanel(route.summary);
        }

        function onError(error) {
            alert("Can't reach the remote server" + error);
        }

        function addRouteShapeToMap(route) {
            let linestring = new H.geo.LineString(),
                routeShape = route.shape,
                startPoint,
                endPoint,
                polyline,
                routeline,
                svgStartMark,
                iconStart,
                startMarker,
                svgEndMark,
                iconEnd,
                endMarker;

            routeShape.forEach(function (point) {
                let parts = point.split(",");
                linestring.pushLatLngAlt(parts[0], parts[1]);
            });

            startPoint = route.waypoint[0].mappedPosition;
            endPoint = route.waypoint[1].mappedPosition;

            polyline = new H.map.Polyline(linestring, {
                style: {
                    lineWidth: 5,
                    strokeColor: "rgba(0, 128, 255, 0.7)",
                    lineTailCap: "arrow-tail",
                    lineHeadCap: "arrow-head",
                },
            });

            routeline = new H.map.Polyline(linestring, {
                style: {
                    lineWidth: 5,
                    fillColor: "white",
                    strokeColor: "rgba(255, 255, 255, 1)",
                    lineDash: [0, 2],
                    lineTailCap: "arrow-tail",
                    lineHeadCap: "arrow-head",
                },
            });

            svgStartMark = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 52 52" style="enable-background:new 0 0 52 52;" xml:space="preserve" width="512px" height="512px"><g><path d="M38.853,5.324L38.853,5.324c-7.098-7.098-18.607-7.098-25.706,0h0  C6.751,11.72,6.031,23.763,11.459,31L26,52l14.541-21C45.969,23.763,45.249,11.72,38.853,5.324z M26.177,24c-3.314,0-6-2.686-6-6  s2.686-6,6-6s6,2.686,6,6S29.491,24,26.177,24z" data-original="#1081E0" class="active-path" data-old_color="#1081E0" fill="#C12020"/></g> </svg>`;

            iconStart = new H.map.Icon(svgStartMark, {
                size: {
                    h: 45,
                    w: 45,
                },
            });

            startMarker = new H.map.Marker(
                {
                    lat: startPoint.latitude,
                    lng: startPoint.longitude,
                },
                {
                    icon: iconStart,
                }
            );

            svgEndMark = `<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 52 52" style="enable-background:new 0 0 52 52;" xml:space="preserve"> <path style="fill:#1081E0;" d="M38.853,5.324L38.853,5.324c-7.098-7.098-18.607-7.098-25.706,0h0 C6.751,11.72,6.031,23.763,11.459,31L26,52l14.541-21C45.969,23.763,45.249,11.72,38.853,5.324z M26.177,24c-3.314,0-6-2.686-6-6 s2.686-6,6-6s6,2.686,6,6S29.491,24,26.177,24z"/></svg>`;

            iconEnd = new H.map.Icon(svgEndMark, {
                size: {
                    h: 45,
                    w: 45,
                },
            });

            endMarker = new H.map.Marker(
                {
                    lat: endPoint.latitude,
                    lng: endPoint.longitude,
                },
                {
                    icon: iconEnd,
                }
            );

            // Add the polyline to the map
            map.addObjects([polyline, routeline, startMarker, endMarker]);

            // And zoom to its bounding rectangle
            map.getViewModel().setLookAtData({
                bounds: polyline.getBoundingBox(),
            });
        }

        function addSummaryToPanel(summary) {
            const sumDiv = document.getElementById("summary");
            const markup = `
                <ul>
                    <li>Total Distance: ${summary.distance / 1000}Km</li>
                    <li>Travel Time: ${summary.travelTime.toMMSS()} (in current traffic)</li>
                </ul>
            `;
            sumDiv.innerHTML = markup;
        }

        if (window.action == "direction") {
            calculateRouteAtoB(platform);
        }
        Number.prototype.toMMSS = function () {
            return (
                Math.floor(this / 60) + " minutes " + (this % 60) + " seconds."
            );
        };
    });
    // Open url direction
    function openDirection(lat, lng, id, role) {
        window.open(
            `${window.baseurl}/${role}/umkm/${id}?from=${objLocalCoord.lat},${objLocalCoord.lng}&to=${lat},${lng}`,
            "_blank"
        );
    }
} else {
    console.error("Geolocation is not suppported by this browser!");
}
