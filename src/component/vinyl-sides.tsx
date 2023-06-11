import { VinylSide } from "../model/vinyl";
import { useCallback } from "react";
import { updateTrack } from "../actions/library";
import useToasts from "../actions/toasts";
import TextEditable from "./text-editable";

interface Props {
    sides: VinylSide[]
}

export default function VinylSides({
    sides
} : Props) {
    const {showToast} = useToasts();
    const onUpdateTrack = useCallback((trackId: number, title: string) => {
        updateTrack(trackId, title).then(() => {
            showToast("Track updated")
        });
    }, [showToast]);

    return (
        <>
            {sides.map(side => (
                <section key={side.id}>
                    <h2>
                        <TextEditable text={side.title} onUpdate={() => {}} />
                    </h2>
                    <ul>
                        {side.tracks.map(track => (
                            <li key={track.id}>
                                <TextEditable 
                                    text={track.title} 
                                    onUpdate={(title) => onUpdateTrack(track.id, title)} />
                            </li>
                        ))}
                    </ul>
                </section>
            ))}
        </>
    )

    // return (
    //     <Accordion defaultActiveKey={opened}>
    //         {sides.map(side => (
    //             <Accordion.Item eventKey={side.id.toString()} key={side.id}>
    //                 <Accordion.Header>{side.title}</Accordion.Header>
    //                 <Accordion.Body>
    //                     {side.tracks.map(track => (
    //                         <VinylTrack track={track.title} key={track.id} 
    //                             onUpdate={(value) => onUpdateTrack(track.id, value)} />
    //                     ))}
    //                 </Accordion.Body>
    //             </Accordion.Item>
    //         ))}
    //     </Accordion>
    // )
}